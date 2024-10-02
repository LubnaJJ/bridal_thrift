<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    // Specify the table if it does not follow Laravel's naming conventions
    protected $table = 'customers';

    // Specify the attributes that can be mass assignable
    protected $fillable = [
        'name',
        'username',
        'email',
        'number',
        'address',
        'age',
        'password',
    ];

    // If you want to hide sensitive information when the model is converted to an array or JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define any custom methods or relationships here if needed
}
