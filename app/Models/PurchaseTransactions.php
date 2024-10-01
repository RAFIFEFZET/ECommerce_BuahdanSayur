<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PurchaseTransactions extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'total_price',
        'transactions_date'
    ];

    protected $dates = [
        'transactions_date',
    ];

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    // Relasi ke model Supplier
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}

