<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $fillable = [
        'numberOrder',
        'status',
        'product_id',
        'discount',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}

