<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'slug',
        'parent',
        'phone',
        'street_address',
        'address_line_2',
        'zip_code',
        'city',
        'country_id',
        'state_id',
        'email_verified_at',
        'status',
        'password',
        
    ];
}
