<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'business_id', 'review_id', 'path', 'caption'];
    
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
