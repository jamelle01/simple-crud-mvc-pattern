<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Use the HasFactory trait to enable factory support for the model
    use HasFactory;

    // Specify the fillable attributes that can be mass assigned
    protected $fillable = ['name', 'description', 'category', 'quantity', 'price', 'image'];
}
