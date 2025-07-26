<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable; // 1. Import the Searchable trait

class Business extends Model
{
    // 2. Use both HasFactory and Searchable traits
    use HasFactory, Searchable;
    
    protected $fillable = [
        'name', 'slug', 'owner_id', 'description', 'address_line_1', 'city', 
        'state', 'zip_code', 'country', 'latitude', 'longitude', 'phone_number', 
        'website_url', 'google_place_id', 'google_opening_hours', 'google_maps_url', 
        'price_range', 'is_verified', 'status', 'meta_title', 'meta_description'
    ];
    
    protected $casts = [
        'google_opening_hours' => 'array',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the indexable data array for the model.
     * This defines what data gets sent to Meilisearch for indexing.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        // We load the categories relationship to include category names in the search index
        $this->load('categories');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'city' => $this->city,
            'address_line_1' => $this->address_line_1,
            // We join the category names into a single string so Meilisearch
            // can search for "Restaurants" or "Hotels" and find the business.
            'categories' => $this->categories->pluck('name')->join(', '),
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
