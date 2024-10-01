<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductCategories;
use App\Models\ProductReviews;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve products based on categories
        $allProducts = Products::all();
        $limitedProducts = $allProducts->take(12); // Ambil maksimal 12 produk
        $vegetableProducts = Products::whereHas('productCategory', function ($query) {
            $query->where('category_name', 'Vegetables');
        })->get();
        $fruitProducts = Products::whereHas('productCategory', function ($query) {
            $query->where('category_name', 'Fruits');
        })->get();

        // Pass the products data to the view
        return view('dashboard.home', compact('limitedProducts', 'vegetableProducts', 'fruitProducts', 'allProducts'));
    }


    public function indexContact()
    {
        return view('dashboard.contact');
    }



    public function productDetail($id)
    {
        // Retrieve the product data from the database
        $product = Products::find($id);
        $review = ProductReviews::all();
        // Check if the product was found
        if ($product) {
            // Pass the product data to the view
            $review = $product->productReviews;
            return view('shopdetail.index', compact('product', 'review'));
        } else {
            // Redirect to a 404 page or another error page
            return abort(404, 'Product not found.');
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        $customerId = Auth::guard('web')->id();
        $productId = $request->input('product_id');

        // Check if the customer has already reviewed the product
        $review = ProductReviews::where('customer_id', $customerId)
                                ->where('product_id', $productId)
                                ->first();

        if ($review) {
            // If a review exists, update it
            $review->comment = $request->input('comment');
            $review->rating = $request->input('rating');
        } else {
            // If no review exists, create a new one
            $review = new ProductReviews();
            $review->customer_id = $customerId;
            $review->product_id = $productId;
            $review->comment = $request->input('comment');
            $review->rating = $request->input('rating');
        }

        $review->save();

        return redirect()->back()->with('success', 'Your review has been submitted!');
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
