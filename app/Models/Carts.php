<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'price',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function discounts()
    {
        return $this->hasMany(Discounts::class, 'product_id');
    }
}
