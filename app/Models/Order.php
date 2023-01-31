<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function items()
    {
        return $this->hasMany(OrderHasItem::class, 'order_id');
    }
    public function status()
    {
        return $this->hasMany(OrderHasStatus::class, 'order_id');
    }
    public function address()
    {
        return $this->hasOne(OderHasAdress::class, 'order_id');
    }
}
