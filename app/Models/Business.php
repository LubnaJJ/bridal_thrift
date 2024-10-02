<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Business extends Model
{
    public function products()
{
    return $this->hasMany(Product::class);
}

    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'businesses'; 

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'business_name',
        'email',
        'address',
        'phone_number',
        'username',
        'password',
    ];

   
}
