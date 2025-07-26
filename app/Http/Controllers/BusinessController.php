<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    public function show(Business $business)
    {
        // Generate a title like "Golden Tulip Hotel in Accra - Ghana Insider"
        $title = "{$business->name} in {$business->city} - Ghana Insider";
        // Use the business's own meta description if it exists, otherwise use its regular description
        $description = $business->meta_description ?? Str::limit($business->description, 155);

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);

        // Eager load the relationships we will need on the page
        $business->load(['categories', 'photos', 'reviews' => function ($query) {
            $query->where('status', 'approved')->latest();
        }, 'reviews.user']);

        // --- SEO Rich Snippet Generation ---
        $localBusinessSchema = Schema::localBusiness()
            ->name($business->name)
            ->description($description) // Use the same description
            ->telephone($business->phone_number)
            ->url(route('business.show', $business))
            ->address(Schema::postalAddress()
                ->streetAddress($business->address_line_1)
                ->addressLocality($business->city)
                ->addressRegion($business->state)
                ->postalCode($business->zip_code)
                ->addressCountry($business->country)
            );

        return view('business.show', [
            'business' => $business,
            'schema' => $localBusinessSchema->toScript(),
        ]);
    }
}
