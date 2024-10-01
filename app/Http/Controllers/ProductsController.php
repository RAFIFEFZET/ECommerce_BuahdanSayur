<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductReviews;
use App\Models\Orders;
use App\Models\Deliveries;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Retrieve products data from the view with pagination and search
        $products = Products::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                            ->select('products.*', 'product_categories.category_name')
                            ->when($search, function ($query, $search) {
                                return $query->where('products.product_name', 'like', '%' . $search . '%')
                                    ->orWhere('product_categories.category_name', 'like', '%' . $search . '%');
                            })
                            ->paginate(10); // Change the number as per your requirement

        return view("products.index", compact('products'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productcategories = ProductCategories::all();
        return view('products.create', compact('productcategories'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function show()
    {
        $customerDeliveries = [];

        if (Auth::check()) {
            $customerDeliveries = Deliveries::whereHas('order', function ($query) {
                    $query->where('customer_id', Auth::id());
                })
                ->where('status', 'Diterima')
                ->get();
        }

        $productsToReview = [];
        foreach ($customerDeliveries as $delivery) {
            foreach ($delivery->order->orderDetails as $orderDetail) {
                $hasReviewed = ProductReviews::where('customer_id', Auth::id())
                                ->where('product_id', $orderDetail->product_id)
                                ->exists();
                if (!$hasReviewed) {
                    $productsToReview[] = $orderDetail->product;
                }
            }
        }

        return view('sidebarpage.reviewproduct', compact('productsToReview'));
    }
     


    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'product_name' => 'required|string|max:100|unique:products,product_name',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stok_quantity' => 'required|integer',
            'image1_url' => 'nullable|image|max:20048',
            'image2_url' => 'nullable|image|max:20048',
            'image3_url' => 'nullable|image|max:20048',
            'image4_url' => 'nullable|image|max:20048',
            'image5_url' => 'nullable|image|max:20048',
        ], [
            'image5_url.max' => 'The image size cannot exceed 20MB.',
        ]);
        
        // Simpan gambar
        $imagePaths = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image'.$i.'_url')) {
                $image = $request->file('image'.$i.'_url');
                $imageName = 'product_' . $i . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/products'), $imageName);
                $imagePaths['image'.$i.'_url'] = 'storage/products/' . $imageName;
            } else {
                // Jika gambar tidak diupload, atur nilai default kosong untuk kolom gambar yang bersangkutan
                $imagePaths['image'.$i.'_url'] = '';
            }
        }

        // Gabungkan path gambar dengan request data
        $stokQuantity = $request->has('stok_quantity') ? $request->input('stok_quantity') : 0;
        // Gabungkan path gambar dengan request data
        $requestData = $request->except(['_token', '_method']);
        $requestData['stok_quantity'] = $stokQuantity;
        $requestData = array_merge($requestData, $imagePaths);

        // Simpan data produk
        Products::create($requestData);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Products::findOrFail($id); // Fetch product data by ID
        $productcategories = ProductCategories::all();
        return view('products.edit', compact('products', 'productcategories')); // Pass product data to the view
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $products = Products::findOrFail($id);
        $oldName = $products->product_name; // Get the current product name

        // Validate the request data
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'product_name' => 'required|string|max:100|unique:products,product_name,' . $id,
            'description' => 'required|string',
            'price' => 'required|integer',
            'stok_quantity' => 'nullable|integer',
            'image1_url' => 'nullable|image|max:20048',
            'image2_url' => 'nullable|image|max:20048',
            'image3_url' => 'nullable|image|max:20048',
            'image4_url' => 'nullable|image|max:20048',
            'image5_url' => 'nullable|image|max:20048',
        ], [
            'image5_url.max' => 'The image size cannot exceed 20MB.',
        ]);

        // Proses gambar yang di-upload
        $imagePaths = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image'.$i.'_url')) {
                $image = $request->file('image'.$i.'_url');
                $imageName = 'product_' . $i . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/products'), $imageName);
                $imagePaths['image'.$i.'_url'] = 'storage/products/' . $imageName;
            } else {
                // Jika gambar tidak diupload, gunakan URL gambar yang lama
                $imagePaths['image'.$i.'_url'] = $products['image'.$i.'_url'];
            }
        }

        // Gabungkan path gambar dengan request data
        $requestData = $request->except(['_token', '_method', 'image1_url', 'image2_url', 'image3_url', 'image4_url', 'image5_url']);
        $requestData = array_merge($requestData, $imagePaths);

        // Update the product
        $products->update($requestData);

        // Return with success message
        return redirect()->route('products.index')->with([
            'status' => 'success',
            'message' => 'Product "' . $oldName . '" has been updated successfully.'
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the product by ID
            $product = Products::findOrFail($id);
            
            // Delete the product
            $product->delete();
            
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            // Handle any errors that occur during deletion
            return redirect()->back()->with('error', 'Failed to delete product');
        }
    }

}
