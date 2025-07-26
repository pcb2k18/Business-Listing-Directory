<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    /**
     * Show the application's homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Set the meta tags for the homepage
        SEOTools::setTitle('Ghana Insider - Find Your Next Favorite Spot in Accra');
        SEOTools::setDescription('Your trusted guide to discovering the best businesses in Ghana. Find real places and authentic reviews for restaurants, hotels, services, and more in Accra.');
        // SEOTools::opengraph()->setUrl(route('home')); // This is a good addition for social sharing

        // Fetch all categories to display in the category grid.
        $categories = Category::all();

        // Fetch a few "trending" or "featured" businesses.
        $trendingBusinesses = Business::latest()->take(8)->get();

        // Return the 'home' view and pass the data to it
        return view('home', [
            'categories' => $categories,
            'trendingBusinesses' => $trendingBusinesses,
        ]);
    }
}
