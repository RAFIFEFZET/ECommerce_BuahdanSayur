<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Products;

class ProductComposer
{
    public function compose(View $view)
    {
        // Ambil produk pertama sebagai contoh, Anda bisa menyesuaikan sesuai kebutuhan
        $product = Products::first();
        $view->with('product', $product);
    }
}
