<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'shipping_cost',
        'total_amount',
        'status',
        'order_date'
    ];
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
