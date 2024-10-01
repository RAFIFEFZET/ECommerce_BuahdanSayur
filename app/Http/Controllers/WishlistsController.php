<?php

namespace App\Http\Controllers;

use App\Models\Wishlists;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class WishlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
            // Retrieve cart items for the authenticated user using eager loading
            $user = auth()->user();
            $wishlists = $user->load('wishlists');
            $products = Products::all();
            // Pass the cart items to the view for rendering
            return view('wishlists.index', compact('wishlists', 'products'));
        } else {
            // Redirect to login page if user is not authenticated
            return redirect()->route('login');
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
        $product = Products::find($request->input('product_id'));
        if ($product) {
            // Check if the product is already in the wishlist for the current customer
            $existingWishlistItem = Wishlists::where('product_id', $product->id)
                ->where('customer_id', Auth::guard('web')->id())
                ->first();

            if ($existingWishlistItem) {
                return redirect()->back()->with('error', "{$product->product_name} is already in your wishlist!");
            }

            // Dapatkan harga setelah diskon jika ada diskon yang aktif
            $price = $product->price;
            if ($product->discounts->isNotEmpty() && $product->discounts->first()->end_date > now()->timezone('Asia/Jakarta')) {
                $price = $product->price - ($product->price * ($product->discounts->first()->percentage / 100));
            }

            // Simpan item ke dalam keranjang dengan harga yang diperbarui
            $wishlist = new Wishlists();
            $wishlist->product_id = $product->id;
            $wishlist->customer_id = Auth::guard('web')->id();
            $wishlist->save();

            return redirect()->back()->with('success', "Berhasil menambahkan {$product->product_name} ke dalam wishlist!");
        } else {
            return redirect()->back()->with('error', 'Product not found!');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Wishlists $wishlists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlists $wishlists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlists $wishlists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlists $wishlist)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login');
        }

        $wishlist->delete();

        return redirect()->route('wishlists.index')->with('success', 'Product removed from wishlist successfully!');
    }
}
