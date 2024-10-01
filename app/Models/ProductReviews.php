<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'rating',
        'comment'
    ];
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
