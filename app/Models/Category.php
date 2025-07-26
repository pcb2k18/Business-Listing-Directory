<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon_svg'];

    public function businesses()
    {
        return $this->belongsToMany(Business::class);
    }

    /**
     * Get the route key for the model.
     * This tells Laravel to use the 'slug' column for URLs.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
