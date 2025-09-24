<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'price', 'detail', 'status', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
}
