<?php

namespace App\Http\Controllers;
use Session;
use App\Models\Carts;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Retrieve cart items for the authenticated user using eager loading
            $user = auth()->user();
            $carts = $user->carts;
            $products = Products::all();
    
            // Check if the cart is empty
            $isCartEmpty = $carts->isEmpty();
    
            // Pass the cart items and the isCartEmpty variable to the view for rendering
            return view('carts.index', compact('carts', 'products', 'isCartEmpty'));
        } else {
            // Redirect to login page if user is not authenticated
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $product = Products::find($request->input('product_id'));
        if ($product) {
            // Dapatkan harga setelah diskon jika ada diskon yang aktif
            $price = $product->price;
            if ($product->discounts->isNotEmpty() && $product->discounts->first()->end_date > now()->timezone('Asia/Jakarta')) {
                $price = $product->price - ($product->price * ($product->discounts->first()->percentage / 100));
            }

            // Check if the product is already in the cart for the current customer
            $existingCartItem = Carts::where('product_id', $product->id)
                ->where('customer_id', Auth::guard('web')->id())
                ->first();

            if ($existingCartItem) {
                // If the product is already in the cart, just increase the quantity
                $existingCartItem->quantity += $request->input('quantity');
                $existingCartItem->save();
            } else {
                // If the product is not in the cart, add a new cart item
                $cart = new Carts();
                $cart->product_id = $product->id;
                $cart->customer_id = Auth::guard('web')->id();
                $cart->price = $price;
                $cart->quantity = $request->input('quantity');
                $cart->save();
            }

            return redirect()->back()->with('success', "Berhasil menambahkan {$product->product_name} ke dalam keranjang!");
        } else {
            return redirect()->back()->with('error', 'Product not found!');
        }
    }
    



    /**
     * Display the specified resource.
     */
    public function show(Carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Carts::find($id);
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        return redirect()->route('carts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carts $cart)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login');
        }

        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Product removed from cart successfully!');
    }
}
