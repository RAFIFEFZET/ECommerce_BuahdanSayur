<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategories;


class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'product_name',
        'description',
        'price',
        'stok_quantity',
        'image1_url',
        'image2_url',
        'image3_url',
        'image4_url',
        'image5_url'     
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReviews::class, 'product_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discounts::class, 'product_id');
    }
    public function purchaseTransactions()
    {
        return $this->hasMany(PurchaseTransactions::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
    
}


