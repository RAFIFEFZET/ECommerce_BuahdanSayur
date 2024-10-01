<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query to fetch orders with customer details and filter by status "Paid"
        $query = DB::table('orders')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(
                'orders.*',
                'customers.name as customer_name'
            )
            ->where('orders.status', 'Paid');

        // Apply search filter if search term is provided
        if ($search) {
            $query->where('customers.name', 'like', '%' . $search . '%');
        }

        // Paginate the results
        $orders = $query->paginate(10);

        return view("orders.index", compact('orders'));
    }


    public function indexUnpaid(Request $request)
    {
        $search = $request->input('search');

        // Query to fetch orders with customer details and filter by status "Unpaid"
        $query = DB::table('orders')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(
                'orders.*',
                'customers.name as customer_name'
            )
            ->where('orders.status', 'Unpaid');

        // Apply search filter if search term is provided
        if ($search) {
            $query->where('customers.name', 'like', '%' . $search . '%');
        }

        // Paginate the results
        $orders = $query->paginate(10);

        return view("unpaidorder.index", compact('orders'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
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
    }

    public function getShippingCost(Request $request)
    {
        $cityId = $request->city_id;
        $weight = 1000; // Berat dalam gram
        $courier = 'jne'; // Kurir yang digunakan (jne, pos, tiki, etc.)

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->post(env('RAJAONGKIR_BASE_URL') . '/cost', [
            'origin' => 23, // ID kota asal
            'destination' => $cityId,
            'weight' => $weight,
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
