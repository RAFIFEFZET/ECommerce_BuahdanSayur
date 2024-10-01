<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;

    protected $fillable = [
       'category_discount_id',
       'product_id',
       'start_date',
       'end_date',
       'percentage'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function isActive() {
        $now = Carbon::now();
        return $this->start_date <= $now && $now <= $this->end_date;
    }
}

