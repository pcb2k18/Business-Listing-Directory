<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the URL (e.g., /search?what=pizza)
        $query = $request->input('what', ''); // Default to empty string if not present

        // Use Laravel Scout to search the 'businesses' index in Meilisearch
        // The `paginate()` method is great because it automatically handles
        // creating page links (e.g., Page 1, Page 2) for us.
        $businesses = Business::search($query)
            ->paginate(12); // Show 12 results per page

        // Return the search results view, passing the businesses and original query
        return view('search.index', [
            'businesses' => $businesses,
            'query' => $query,
        ]);
    }
}
