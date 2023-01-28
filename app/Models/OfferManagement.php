<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'description',
        'type',
        'applicable_shows',
        'discount_amount',
        'status'  
    ];
}
