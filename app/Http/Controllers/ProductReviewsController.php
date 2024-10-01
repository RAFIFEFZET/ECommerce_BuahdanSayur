<?php

namespace App\Http\Controllers;

use App\Models\ProductReviews;
use App\Models\Products;
use App\Models\Customers;
use Illuminate\Http\Request;

class ProductReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

    // Retrieve product reviews data from the view with pagination and search
    $productreviews = ProductReviews::join('customers', 'product_reviews.customer_id', '=', 'customers.id')
        ->join('products', 'product_reviews.product_id', '=', 'products.id')
        ->select('product_reviews.*', 'customers.name', 'products.product_name')
        ->when($search, function ($query, $search) {
            return $query->where('product_reviews.comment', 'like', '%' . $search . '%')
                ->orWhere('customers.name', 'like', '%' . $search . '%')
                ->orWhere('products.product_name', 'like', '%' . $search . '%');
        })
        ->paginate(10);

    return view("product_reviews-admin.index", compact('productreviews'));

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
    public function show(ProductReviews $productReviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductReviews $productReviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductReviews $productReviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductReviews $productReviews)
    {
        //
    }
}
