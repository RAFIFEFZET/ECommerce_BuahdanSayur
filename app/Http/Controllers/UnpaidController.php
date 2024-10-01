<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\Carts;
use App\Models\Orders;

class UnpaidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $customer = Auth::guard('web')->user();
            $orders = Orders::where('customer_id', $customer->id)->where('status', 'Unpaid')->get();
        } else {
            $customer = null;
            $orders = collect();
        }
        if (Auth::guard('web')->check()) {
            $cartItems = Carts::where('customer_id', Auth::guard('web')->user()->id)->with('product')->get();
        } else {
            $cartItems = null;
        }

        return view('sidebarpage.unpaidorder', compact('customer', 'orders', 'cartItems'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
