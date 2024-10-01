<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlists extends Model
{
    use HasFactory;

    protected $fillable = [
      'customer_id',
      'product_id'  
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
    public function discounts()
    {
        return $this->hasMany(Discounts::class, 'product_id');
    }
}
