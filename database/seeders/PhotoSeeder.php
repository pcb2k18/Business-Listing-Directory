<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\Photo;
use App\Models\User;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        // First, let's make sure we have at least one user to assign photos to.
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create();
        }

        $businesses = Business::all();

        foreach ($businesses as $business) {
            // Let's give each business a unique set of photos
            if (str_contains($business->name, 'Coffee House')) {
                $photoPaths = [
                    'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1000',
                    'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?auto=format&fit=crop&w=300',
                    'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=300',
                ];
            } elseif (str_contains($business->name, 'Golden Tulip')) {
                $photoPaths = [
                    'https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg?auto=compress&cs=tinysrgb&w=1000',
                    'https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'https://images.pexels.com/photos/70441/pexels-photo-70441.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'https://images.pexels.com/photos/271643/pexels-photo-271643.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'https://images.pexels.com/photos/1457842/pexels-photo-1457842.jpeg?auto=compress&cs=tinysrgb&w=300',
                ];
            } else {
                // Default photos for other businesses
                $photoPaths = [
                    'https://images.pexels.com/photos/262978/pexels-photo-262978.jpeg?auto=compress&cs=tinysrgb&w=1000',
                ];
            }

            foreach ($photoPaths as $path) {
                Photo::create([
                    'business_id' => $business->id,
                    'user_id' => $user->id, // Assign the photo to a user
                    'path' => $path,
                ]);
            }
        }
    }
}
