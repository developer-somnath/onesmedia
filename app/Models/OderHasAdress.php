<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OderHasAdress extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class, 'user_id');
    }
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
    public function state()
    {
        return $this->belongsTo(States::class, 'state_id');
    }
}
