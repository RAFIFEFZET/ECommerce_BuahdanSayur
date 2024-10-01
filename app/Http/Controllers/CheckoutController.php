<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Orders;
use App\Models\Products;
use App\Models\OrderDetails;
use App\Models\Carts;
use App\Models\User;
use App\Models\Discounts;
use App\Models\Deliveries;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\TrackingCodeGenerator;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function order(Request $request)
    {
        // Autentikasi apakah customer sudah login?
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Please login to place an order!');
        }

        // Mengambil data customer yang sedang login
        $customer = Auth::guard('web')->user();

        // mengambil data cart berdasarkan id customer yang login
        $cartItems = Carts::where('customer_id', $customer->id)->with('product')->get();

        // Ensure cart is not empty
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add items before placing an order!');
        }

        // Kalkulasi harga. jika item memiliki discount maka dia akan mendiskonkan harganya, jika tidak maka akan mengirimkan harga aslinya
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $productPrice = $product->price;
            if ($product->discounts->isNotEmpty() && $product->discounts->first()->end_date > now()->timezone('Asia/Jakarta')) {
                $productPrice = $product->price - ($product->price * ($product->discounts->first()->percentage / 100));
            }
            $totalPrice += $productPrice * $cartItem->quantity;
        }

        // Get shipping cost from the request
        $shippingCost = $request->input('shipping_cost');

        // Add shipping cost to the total price
        $totalPriceWithShipping = $totalPrice + $shippingCost;

        // Create a new order
        $order = new Orders;
        $order->customer_id = $customer->id;
        $order->total_amount = $totalPriceWithShipping;
        $order->order_date = Carbon::now('Asia/Jakarta');
        $order->status = 'Unpaid';
        $order->shipping_cost = $shippingCost;
        $order->id = $this->generateUniqueId();
        $order->save();

        // Redirect to payment page with Snap Token and other required data
        return redirect()->route('checkout-payment.index', compact('totalPriceWithShipping'));
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order_id');

        // Cari pesanan dengan ID yang diberikan
        $order = Orders::findOrFail($orderId);

        // Perbarui status pesanan menjadi "paid"
        $order->status = 'Paid';
        $order->save();

        $customerCart = Carts::where('customer_id', $order->customer_id)->get();

        // Pindahkan data dari tabel keranjang ke tabel OrderHistory
        foreach ($customerCart as $cartItem) {
            // Kurangi jumlah stok produk
            $product = Products::findOrFail($cartItem->product_id);
            $product->stok_quantity -= $cartItem->quantity;
            $product->save();

            // Buat entri di OrderDetails
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'subtotal' => $order->total_amount, // Gunakan total_amount dari pesanan
                'quantity' => $cartItem->quantity,
            ]);

            // Hapus entri keranjang
            $cartItem->delete();
        }

        // Buat entri baru di tabel Deliveries
        $trackingCode = substr(TrackingCodeGenerator::generate(), 0, 20);

        Deliveries::create([
            'order_id' => $order->id,
            'shipping_date' => now()->setTimezone('Asia/Jakarta'),
            'tracking_code' => $trackingCode,
            'status' => 'Menunggu Konfirmasi',
        ]);

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('home')->with('success', 'Payment successful!');
    }




    public function generateUniqueId()
    {
        $uuid = Str::uuid()->getHex(); // Mendapatkan UUID dalam bentuk hexadecimal
        $numericId = hexdec(substr($uuid, 0, 11)); // Mengonversi 11 karakter pertama menjadi angka desimal
        return (string)$numericId; // Mengembalikan ID dalam format string
    }

    public function index()
    {
        // Mengambil data provinsi dari RajaOngkir
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . '/province');

        $provinces = $response['rajaongkir']['results'];

        // Mengambil data keranjang berdasarkan customer yang login
        $customer = Auth::guard('web')->user();
        $cartItems = $customer ? Carts::where('customer_id', $customer->id)->with('product')->get() : collect();

        return view('checkout.index', compact('cartItems', 'customer', 'provinces'));
    }

    public function getCity(Request $request)
    {
        $provinceId = $request->province_id;

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . '/city', [
            'province' => $provinceId
        ]);

        if ($response->successful()) {
            $cities = $response['rajaongkir']['results'];
            return response()->json($cities);
        } else {
            return response()->json(['error' => 'Failed to fetch cities'], 500);
        }
        compact('provinceId', 'response', 'cities');
    }

    public function getShippingCost(Request $request)
{
    $cityId = $request->city_id;
    $courier = 'jne'; // Kurir yang digunakan (jne, pos, tiki, etc.)

    // Mengambil data keranjang berdasarkan customer yang login
    $customer = Auth::guard('web')->user();
    $cartItems = $customer ? Carts::where('customer_id', $customer->id)->with('product')->get() : collect();

    $totalWeight = 0;

    foreach ($cartItems as $cart) {
        $totalWeight += $cart->quantity;
    }

    // Convert the total weight to grams (1 quantity = 1kg = 1000 grams)
    $weightInGrams = $totalWeight * 1000;

    $response = Http::withHeaders([
        'key' => env('RAJAONGKIR_API_KEY')
    ])->post(env('RAJAONGKIR_BASE_URL') . '/cost', [
        'origin' => 23, // ID kota asal
        'destination' => $cityId,
        'weight' => $weightInGrams,
        'courier' => $courier
    ]);

    if ($response->successful()) {
        $costs = $response['rajaongkir']['results'][0]['costs'];
        return response()->json($costs);
    } else {
        return response()->json(['error' => 'Failed to fetch shipping cost'], 500);
    }
}

}
