<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Spatie\SchemaOrg\Schema;

class CategoryController extends Controller
{
    /**
     * Display the specified category and its businesses.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        // --- 1. SET DYNAMIC META TAGS ---
        $title = "List of {$category->name} in Accra. Find the Nearest Place";
        $description = "Find the nearest {$category->name} in Accra. Real Places, Real Reviews. Get the best recommendations on Ghana Insider.";

        SEOTools::setTitle($title);
        SEOTools::setDescription($description);

        // --- 2. GET PAGINATED BUSINESSES ---
        $businesses = $category->businesses()->paginate(9);

        // --- 3. GENERATE SCHEMA.ORG FOR THE CURRENT PAGE ---
        $itemList = Schema::itemList();
        $listItems = [];
        
        foreach ($businesses as $index => $business) {
            $listItems[] = Schema::listItem()
                ->position($businesses->firstItem() + $index)
                ->url(route('business.show', $business))
                ->name($business->name);
        }
        $itemList->itemListElement($listItems);

        // --- 4. RETURN THE VIEW WITH ALL THE DATA ---
        return view('categories.show', [
            'category' => $category,
            'businesses' => $businesses,
            'schema' => $itemList->toScript(),
        ]);
    }

} // <--- THIS IS THE MISSING BRACE THAT FIXES THE ERROR
