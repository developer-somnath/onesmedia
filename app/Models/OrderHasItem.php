<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHasItem extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class, 'user_id');
    }

    public function show()
    {
        return $this->belongsTo(Shows::class, 'item_id');
    }
}
