<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAndProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'orginal_file_name',
        'file',
        'image',
        'price',
        'quantity',
        'description',
        'parent',
        'type',
        'status'
        
    ];
}
