<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnotherPays extends Model
{
    //
    use HasFactory;
     protected $table = 'anotherpays'; // 👈 Fix here
    protected $fillable = [
        'price',
        'note',
    ];
}
