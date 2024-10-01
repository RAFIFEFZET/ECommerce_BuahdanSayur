<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Products;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Retrieve product categories data from the view with pagination and search
        $product_categories = ProductCategories::query()
            ->when($search, function ($query, $search) {
                return $query->where('category_name', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view("product_categories.index", compact('product_categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategories::all();
        return view('product_categories.create', compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only(['category_name']);
            ProductCategories::create($data);
            return redirect()->route('product_categories.index')->with([
                'status' => 'success',
                'message' => 'New Product Category with the name "' . $request->category_name . '" has been successfully added.'
            ]);
        } catch (QueryException $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == 1062) { // Integrity constraint violation error code
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Duplicate entry! A Product Category with the same name already exists.'
                ]);
            } else {
                // Handle other types of database errors
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'Database error occurred. Please try again later.'
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = ProductCategories::findOrFail($id);
        return view('product_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = ProductCategories::findOrFail($id);
        $oldName = $category->category_name; // Get the current category name
        $category->update($request->only(['category_name']));
        return redirect()->route('product_categories.index')->with([
            'status' => 'success',
            'message' => 'Product Category "' . $oldName . '" has been updated to "' . $category->category_name . '" successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = ProductCategories::findOrFail($id);
        $category->delete();
        return redirect()->route('product_categories.index')->with([
            'status' => 'delete',
            'pesan' => 'Product Category with ID ' . $id . ' has been deleted successfully.'
        ]);
    }
}
