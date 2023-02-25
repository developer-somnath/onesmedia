<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCost extends Model
{
    use HasFactory;
    protected $fillable = [
        'price_for_single_qty', 
        'price_for_double_qty', 
        'price_for_more_than_three_or_equal'
    ];
}
