<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductCategories;
use App\Models\ProductReviews;
use Illuminate\Support\Facades\Auth;


class AllProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Products::query();

        // Search
        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Filter by Product Category
        if ($request->has('filter') && $request->filter != '') {
            if ($request->filter == 'discount') {
                $query->whereHas('discounts', function ($q) {
                    $q->where('end_date', '>', now()->timezone('Asia/Jakarta'));
                });
            } else {
                $query->whereHas('productCategory', function ($q) use ($request) {
                    $q->where('category_name', $request->filter);
                });
            }
        }

        // Pagination
        $products = $query->paginate(6); // 9 items per page

        return view('dashboard.allproducts', compact('products'));
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
    
    }

    public function destroy($id)
    {
        
    }
}