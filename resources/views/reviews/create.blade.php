@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Header -->
            <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Write a review for {{ $business->name }}</h1>
            {{-- This will display a list of validation errors if they exist --}}
@if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Oops! Something went wrong.</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- Review Form -->
            <form action="{{ route('reviews.store', $business) }}" method="POST" class="space-y-6" class="space-y-6" x-data="{ rating: 0, hoverRating: 0 }">@csrf
                <!-- Star Rating Component -->
                <div class="space-y-3">
                    <label class="block text-lg font-medium text-gray-700">Your Rating:</label>
                    <div class="flex items-center space-x-1" @mouseleave="hoverRating = 0">
                        <!-- Star 1 -->
                        <svg class="w-8 h-8 cursor-pointer transition-colors duration-150" 
                             viewBox="0 0 20 20" 
                             fill="currentColor"
                             :class="(hoverRating >= 1 || rating >= 1) ? 'text-yellow-400' : 'text-gray-300'"
                             @mouseenter="hoverRating = 1"
                             @click="rating = 1">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        
                        <!-- Star 2 -->
                        <svg class="w-8 h-8 cursor-pointer transition-colors duration-150" 
                             viewBox="0 0 20 20" 
                             fill="currentColor"
                             :class="(hoverRating >= 2 || rating >= 2) ? 'text-yellow-400' : 'text-gray-300'"
                             @mouseenter="hoverRating = 2"
                             @click="rating = 2">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        
                        <!-- Star 3 -->
                        <svg class="w-8 h-8 cursor-pointer transition-colors duration-150" 
                             viewBox="0 0 20 20" 
                             fill="currentColor"
                             :class="(hoverRating >= 3 || rating >= 3) ? 'text-yellow-400' : 'text-gray-300'"
                             @mouseenter="hoverRating = 3"
                             @click="rating = 3">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        
                        <!-- Star 4 -->
                        <svg class="w-8 h-8 cursor-pointer transition-colors duration-150" 
                             viewBox="0 0 20 20" 
                             fill="currentColor"
                             :class="(hoverRating >= 4 || rating >= 4) ? 'text-yellow-400' : 'text-gray-300'"
                             @mouseenter="hoverRating = 4"
                             @click="rating = 4">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        
                        <!-- Star 5 -->
                        <svg class="w-8 h-8 cursor-pointer transition-colors duration-150" 
                             viewBox="0 0 20 20" 
                             fill="currentColor"
                             :class="(hoverRating >= 5 || rating >= 5) ? 'text-yellow-400' : 'text-gray-300'"
                             @mouseenter="hoverRating = 5"
                             @click="rating = 5">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    
                    <!-- Hidden input for form submission -->
                    <input type="number" name="rating" x-model="rating" class="hidden">
                    
                    <!-- Rating feedback text -->
                    <div class="text-sm text-gray-600" x-show="rating > 0">
                        <span x-text="rating === 1 ? 'Poor' : rating === 2 ? 'Fair' : rating === 3 ? 'Good' : rating === 4 ? 'Very Good' : 'Excellent'"></span>
                    </div>
                </div>

                <!-- Review Text Area -->
                <div class="space-y-3">
                    <label for="content" class="block text-lg font-medium text-gray-700">Your Review</label>
                    <textarea 
                        id="content" 
                        name="content" 
                        rows="8" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                        placeholder="Share details of your own experience at this place. What did you like or dislike? What should other insiders know?"
                        required></textarea>
                    <div class="text-sm text-gray-500">
                        Help others by writing a detailed and honest review.
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-md text-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 disabled:bg-gray-400 disabled:cursor-not-allowed"
                        :disabled="rating === 0"
                        :class="rating === 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700'">
                        Submit Review
                    </button>
                    <div class="text-sm text-gray-500 text-center mt-2" x-show="rating === 0">
                        Please select a star rating before submitting
                    </div>
                </div>
            </form>

            <!-- Back to Business Link -->
            <div class="mt-8 text-center">
                <a href="{{ route('business.show', $business) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    ← Back to {{ $business->name }}
                </a>
            </div>
        </div>
    </div>
</body>
@endsection
</html>
