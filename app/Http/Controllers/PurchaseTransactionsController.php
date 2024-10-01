<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseTransactions;
use App\Models\Suppliers;
use App\Models\Products;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PurchaseTransactionsImport;
use App\Exports\PurchaseTransactionsExport;
use Carbon\Carbon;

class PurchaseTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexReport()
    {
        return view('laporan.purchase_transactions');
    }

    public function generatePDF(Request $request)
    {
        // Parsing tanggal dari request
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Ambil data pembelian dalam rentang tanggal
        $purchaseTransactions = PurchaseTransactions::with(['product', 'supplier'])
            ->whereBetween('transactions_date', [$startDate, $endDate])
            ->get();

        // Hitung total pengeluaran
        $totalExpense = $purchaseTransactions->sum('total_price');

        // Buat PDF
        $pdf = PDF::loadView('laporan.purchase_transactions_pdf', compact('purchaseTransactions', 'startDate', 'endDate', 'totalExpense'));

        // Download PDF
        return $pdf->download('purchase_transactions.pdf');
    }

    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new PurchaseTransactionsImport, $request->file('file'));

        return redirect()->route('purchasetransactions.index')->with('status', 'success')->with('message', 'Data imported successfully.');
    }
    
    public function export()
    {
        return Excel::download(new PurchaseTransactionsExport, 'purchase_transactions.xlsx');
    }
    
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Query untuk mendapatkan semua transaksi pembelian
        $query = PurchaseTransactions::query();

        // Jika ada pencarian, tambahkan kondisi pencarian
        if ($search) {
            $query->where('id', 'LIKE', "%{$search}%")
                ->orWhereHas('supplier', function($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('supplier', function($query) use ($search) {
                    $query->where('email', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('product', function($query) use ($search) {
                    $query->where('product_name', 'LIKE', "%{$search}%");
                });
        }

        // Dapatkan hasil pencarian dengan pagination
        $transactions = $query->with(['supplier', 'product'])->paginate(10);

        return view('purchasetransactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Suppliers::all();
        $products = Products::all();
        return view('purchasetransactions.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|integer|min:1',
            'transactions_date' => 'required|date',
        ]);

        $transaction = PurchaseTransactions::create($request->all());

        // Update stok produk
        $product = Products::find($transaction->product_id);
        $product->stok_quantity += $transaction->quantity;
        $product->save();

        return redirect()->route('purchasetransactions.index')->with('status', 'success')->with('message', 'Purchase transaction created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaction = PurchaseTransactions::findOrFail($id);
        $products = Products::all();
        $suppliers = Suppliers::all();
        return view('purchasetransactions.edit', compact('transaction', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'transactions_date' => 'required|date',
        ]);

        $transaction = PurchaseTransactions::findOrFail($id);

        // Hitung perubahan jumlah stok
        $oldQuantity = $transaction->quantity;
        $newQuantity = $request->input('quantity');
        $quantityDifference = $newQuantity - $oldQuantity;

        $transaction->update($request->all());

        // Update stok produk
        $product = Products::find($transaction->product_id);
        $product->stok_quantity += $quantityDifference;
        $product->save();

        return redirect()->route('purchasetransactions.index')->with('status', 'success')->with('message', 'Purchase transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = PurchaseTransactions::findOrFail($id);

        // Kurangi stok produk sebelum menghapus transaksi
        $product = Products::find($transaction->product_id);
        $product->stok_quantity -= $transaction->quantity;
        $product->save();

        $transaction->delete();

        return redirect()->route('purchasetransactions.index')->with('success', 'Purchase transaction deleted successfully.');
    }
}
