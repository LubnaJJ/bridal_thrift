<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
        'description',
        'quantity',
        'price',
        'image',
    ];

    // Product.php (Model)
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

}


