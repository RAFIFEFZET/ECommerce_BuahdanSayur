<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Discounts;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $discount = Discounts::join('products', 'discounts.product_id', '=', 'products.id')
                            ->select('discounts.*', 'products.product_name')
                            ->when($search, function ($query, $search) {
                                return $query->where('products.product_name', 'like', '%' . $search . '%')
                                    ->orWhere('discounts.start_date', 'like', '%' . $search . '%')
                                    ->orWhere('discounts.end_date', 'like', '%' . $search . '%');
                            })
                            ->paginate(10);
                            
        $products = Products::with(['productCategory', 'discounts'])
        ->whereHas('discounts', function ($query) {
            $query->where('end_date', '>', Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString());
        })
        ->get();

            return view("discounts-admin.index", compact('discount'));              
    }


    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Products::all();
        return view('discounts-admin.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required',
            'end_date' => 'required',
            'percentage' => 'required|integer',
        ]);    

        // Gabungkan path gambar dengan request data
        $requestData = $request->except(['_token', '_method']);
        $requestData = array_merge($requestData);

        // Simpan data produk
        Discounts::create($requestData);

        return redirect()->route('discounts-admin.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discounts $discounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discount = Discounts::findOrFail($id); // Fetch product data by ID
        $products = Products::all();
        $selectedProductId = $discount->product_id;
        return view('discounts-admin.edit', compact('products', 'discount','selectedProductId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $discount = Discounts::findOrFail($id);
        $olddate = $discount->start_date;
        $newdate = $discount->end_date;

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required',
            'end_date' => 'required',
            'percentage' => 'required|integer',
        ]);
        

        $discount->update($request->except(['_token', '_method']));

        // Return with success message
        return redirect()->route('discounts-admin.index')->with([
            'status' => 'success',
            'message' => 'Product wirh date of "' . $olddate . '" has been updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the product by ID
            $discount = Discounts::findOrFail($id);
            
            // Delete the product
            $discount->delete();
            
            return redirect()->route('discounts-admin.index')->with('success', 'Discount deleted successfully');
        } catch (\Exception $e) {
            // Handle any errors that occur during deletion
            return redirect()->back()->with('error', 'Failed to Discount product');
        }
    }
}
