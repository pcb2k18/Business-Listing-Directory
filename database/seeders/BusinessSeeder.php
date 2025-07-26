<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Support\Str;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        // Get all category IDs
        $categoryIds = Category::pluck('id');

$businesses = [
    [
        'name' => 'The Coffee House',
        'description' => 'A cozy spot for artisanal coffee and pastries.',
        'address_line_1' => '123 Oxford Street',
        'city' => 'Accra',
        'price_range' => '₵₵',
        'ai_summary' => "Pros: Famous for its rich artisanal coffee and calm, work-friendly atmosphere.\nCons: Can get crowded during peak morning hours, limited food menu."
    ],
    [
        'name' => 'Golden Tulip Hotel',
        'description' => 'Luxury accommodation with world-class amenities.',
        'address_line_1' => 'Liberation Road',
        'city' => 'Accra',
        'price_range' => '₵₵₵₵',
        'ai_summary' => "Pros: Excellent customer service, spacious and clean rooms, beautiful pool area.\nCons: Restaurant prices can be high, Wi-Fi can be slow at times."
    ],
    [
        'name' => 'Mama Mia Restaurant',
        'description' => 'Authentic Ghanaian & Italian cuisine in a vibrant atmosphere.',
        'address_line_1' => 'Osu Badu Street',
        'city' => 'Accra',
        'price_range' => '₵₵₵',
        'ai_summary' => "Pros: A unique fusion of Ghanaian and Italian dishes, vibrant live music on weekends.\nCons: Service can be slow during dinner rush, reservations recommended."
    ],
    [
        'name' => 'Elite Spa & Wellness',
        'description' => 'Your escape for relaxation and rejuvenation.',
        'address_line_1' => 'East Legon Hills',
        'city' => 'Accra',
        'price_range' => '₵₵₵',
        'ai_summary' => "Pros: Professional and skilled staff, very clean and serene environment.\nCons: Booking in advance is almost always necessary, located far from the city center."
    ],
];

        foreach ($businesses as $businessData) {
            $business = Business::create([
                'name' => $businessData['name'],
                'slug' => Str::slug($businessData['name']),
                'description' => $businessData['description'],
                'address_line_1' => $businessData['address_line_1'],
                'city' => $businessData['city'],
                'state' => 'Greater Accra',
                'zip_code' => '00233',
                'country' => 'Ghana',
                'price_range' => $businessData['price_range'],
                'ai_summary' => $businessData['ai_summary'] ?? null,
            ]);

            // Attach 1 to 2 random categories to this business
            $business->categories()->attach(
                $categoryIds->random(rand(1, 2))->all()
            );
        }
    }
}
