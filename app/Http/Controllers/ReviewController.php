<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new review.
     */
    public function create(Business $business)
    {
        // We will create this view in the next step
        return view('reviews.create', ['business' => $business]);
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, Business $business)
    {
        // 1. Validate the incoming data from the form
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:50',
        ]);

        // 2. Create the review and link it to the business and the currently logged-in user
        $business->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            // The 'status' will default to 'pending' as defined in our migration
        ]);

        // 3. Redirect the user back to the business page with a success message
        return redirect()->route('business.show', $business)
            ->with('success', 'Thank you! Your review has been submitted and is pending approval.');
    }
}
