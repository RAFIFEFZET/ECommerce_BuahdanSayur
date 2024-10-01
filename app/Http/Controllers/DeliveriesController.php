<?php

namespace App\Http\Controllers;

use App\Models\Deliveries;
use Illuminate\Http\Request;


class DeliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Deliveries::with('order.product', 'order.customer')->paginate(10);
        return view('deliveries.index', compact('deliveries'));
    }

    public function indexCustomer()
    {
        // Ambil ID pelanggan dari sesi atau mana pun Anda menyimpannya
        $customerId = auth()->user()->id; // Contoh: Ambil ID pelanggan dari pengguna yang sedang login

        // Ambil data pengiriman berdasarkan ID pelanggan
        $deliveries = Deliveries::whereHas('order', function ($query) use ($customerId) {
            $query->where('customer_id', $customerId);
        })->get();

        // Kirim data ke tampilan Blade
        return view('sidebarpage.orderstatus', compact('deliveries'));
    }

    public function confirmOrder(Deliveries $delivery)
    {
        // Perbarui status pengiriman menjadi "Diterima"
        $delivery->status = 'Diterima';
        $delivery->save();

        // Redirect kembali ke halaman order status
        return redirect()->route('sidebarpage.orderstatus')->with('success', 'Pesanan telah dikonfirmasi.');
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
        $data = $request->only(['status']);
        Deliveries::create($data);
        return redirect()->route('product_categories.index')->with([
            'status' => 'success',
            'message' => 'status "' . $request->status . '" has been successfully updated.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deliveries $deliveries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $statusupdate = Deliveries::findOrFail($id);
        return view('deliveries.edit', compact('statusupdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $statusupdate = Deliveries::findOrFail($id);
        $oldStatus = $statusupdate->status;
        $statusupdate->update($request->only(['status']));
        
        return redirect()->route('deliveries.index')->with([
            'status' => 'success',
            'message' => 'Status "' . $oldStatus . '" telah berhasil diperbarui menjadi "' . $statusupdate->status . '".'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deliveries $deliveries)
    {
        //
    }
}
