<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $paymentsQuery = Payments::query();

        // Apply search filter if search query exists
        if ($search) {
            $paymentsQuery->where('order_id', 'LIKE', "%$search%")
                        ->orWhere('payment_date', 'LIKE', "%$search%")
                        ->orWhere('payment_method', 'LIKE', "%$search%")
                        ->orWhere('amount', 'LIKE', "%$search%");
        }

        // Get paginated results
        $payments = $paymentsQuery->paginate(10);

        return view('payments.index', compact('payments', 'search'));
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
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
