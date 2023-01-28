<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shows extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 
        'title', 
        'image', 
        'description', 
        'no_of_episodes', 
        'no_of_mp3_cds', 
        'instant_download_price', 
        'mp3_cd_price', 
        'sample_file',
        'show_year',
        'status'  
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
