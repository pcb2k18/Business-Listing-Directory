@extends('layouts.app')

@section('title', $business->name . ' - Ghana Insider')

{{-- This pushes the SEO Rich Snippet script into the <head> of the master layout --}}
@push('head')
    {!! $schema !!}
@endpush

@section('content')
    <!-- Photo Gallery Header -->
 <!-- Photo Gallery Header -->
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto">
        @if($business->photos->isNotEmpty())
            @php
                $heroPhoto = $business->photos->first();
                // Get the next 4 photos for the grid.
                $gridPhotos = $business->photos->slice(1)->take(4);
            @endphp

            <div class="relative h-80 md:h-96 bg-gray-300 overflow-hidden">
                <img src="{{ $heroPhoto->path }}" 
                     alt="Main image for {{ $business->name }}" 
                     class="w-full h-full object-cover">
            </div>
            
            @if($gridPhotos->isNotEmpty())
                <div class="px-4 py-4">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 max-w-4xl">
                        {{-- Loop through a maximum of 3 thumbnails normally --}}
                        @foreach($gridPhotos->take(3) as $photo)
                            <div class="aspect-square">
                                <img src="{{ $photo->path }}" 
                                     alt="Thumbnail image for {{ $business->name }}" 
                                     class="w-full h-full object-cover rounded cursor-pointer hover:opacity-75 transition-opacity">
                            </div>
                        @endforeach

                        {{-- Handle the 4th grid slot specially --}}
                        @if($gridPhotos->has(3)) {{-- Check if a 4th thumbnail exists --}}
                            <div class="relative aspect-square">
                                <img src="{{ $gridPhotos->get(3)->path }}" 
                                     alt="More photos thumbnail" 
                                     class="w-full h-full object-cover rounded {{ $business->photos->count() > 5 ? 'brightness-50' : 'cursor-pointer hover:opacity-75' }}">
                                
                                {{-- If there are MORE than 5 total photos, show the "View all" overlay --}}
                                @if($business->photos->count() > 5)
                                    <div class="absolute inset-0 rounded flex items-center justify-center">
                                        <button class="text-white text-sm font-medium hover:bg-black hover:bg-opacity-25 px-2 py-1 rounded transition-colors">
                                            View all photos
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="relative h-80 md:h-96 bg-gray-300 flex items-center justify-center">
                <p class="text-gray-500">No photos available for this business.</p>
            </div>
        @endif
    </div>
</div>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-4">
      @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Main Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Business Header -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $business->name }}</h1>
                    
                    {{-- Rating Section: Only shows if there are approved reviews --}}
                    @if($business->reviews->count() > 0)
                        <div class="flex items-center mb-3">
                            <div class="flex items-center space-x-1 mr-3">
                                {{-- Loop to display the correct number of stars --}}
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= round($business->reviews->avg('rating')) ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>
                            <a href="#reviews" class="text-blue-600 hover:underline">
                                {{-- Display formatted average rating and review count --}}
                                <span class="font-semibold">{{ number_format($business->reviews->avg('rating'), 1) }}</span> 
                                ({{ $business->reviews->count() }} {{ Str::plural('review', $business->reviews->count()) }})
                            </a>
                        </div>
                    @else
                        <div class="mb-3">
                            <a href="{{ route('reviews.create', $business) }}" class="text-blue-600 hover:underline">Be the first to write a review!</a>
                        </div>
                    @endif

                    {{-- Price and Categories Section --}}
                    <div class="flex items-center flex-wrap gap-x-2 text-gray-600 mb-4">
                        @if($business->price_range)
                            <span class="font-semibold text-green-600">{{ $business->price_range }}</span>
                        @endif
                        {{-- Loop through all associated categories and create links --}}
                        @foreach($business->categories as $category)
                            <span>•</span>
                            <a href="{{ route('categories.show', $category) }}" class="hover:text-blue-600">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    {{-- Business Description --}}
@if($business->description)
    <p class="text-gray-700 mt-4">
        {{ $business->description }}
    </p>
@endif
<br>
                    {{-- AI-Powered Summary Section --}}
                  {{-- AI-Powered Summary --}}
@if($business->ai_summary)
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 my-6">
        <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-blue-900 mb-2">AI-Powered Summary</h3>
                {{-- The nl2br function preserves line breaks from the database --}}
                <p class="text-blue-800 text-sm">
                    {!! nl2br(e($business->ai_summary)) !!}
                </p>
            </div>
        </div>
    </div>
@endif
                    {{-- Action Buttons Section --}}
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('reviews.create', $business) }}" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg><span>Write a Review</span></a>
                        <a href="#" class="flex items-center space-x-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg><span>Add Photo</span></a>
                        <a href="#" class="flex items-center space-x-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg><span>Save</span></a>
                        <a href="#" class="flex items-center space-x-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path></svg><span>Share</span></a>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div id="reviews" class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Reviews</h2>

                    {{-- Individual Reviews Loop --}}
                    <div class="space-y-6">
                        @forelse($business->reviews as $review)
                            <div class="border-b border-gray-200 pb-6 last:border-b-0">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 flex-shrink-0">
                                        {{-- User's initials as a placeholder avatar --}}
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $review->created_at->format('F d, Y') }}</p>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                {{-- Loop to show the rating for this specific review --}}
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20">
                                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-gray-700">{{ $review->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-600">This business has no reviews yet.</p>
                                <a href="{{ route('reviews.create', $business) }}" class="mt-2 inline-block text-blue-600 hover:underline">Be the first to write a review!</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column - Contact & Info Sidebar -->
            <div class="space-y-6">
                <!-- Map -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="h-48 bg-gray-300 relative">
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=400" 
                             alt="Map location for {{ $business->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <!-- Address -->
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div>
                                <p class="text-gray-900 font-medium">{{ $business->address_line_1 }}</p>
                                <p class="text-gray-600">{{ $business->city }}, {{ $business->state }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        @if($business->phone_number)
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <a href="tel:{{ $business->phone_number }}" class="text-blue-600 hover:underline">{{ $business->phone_number }}</a>
                        </div>
                        @endif

                        <!-- Website -->
                        @if($business->website_url)
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9"></path></svg>
                            <a href="{{ $business->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-blue-600 hover:underline">
                                Visit Website
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hours</h3>
                    {{-- This Alpine.js component remains the same. We will wire it up to our dynamic DB data in a future step --}}
                    <div class="space-y-2" x-data="{ currentDay: new Date().getDay() }">
                        <div class="flex justify-between items-center py-1" :class="currentDay === 1 ? 'bg-blue-50 px-2 rounded font-medium' : ''"><span class="text-gray-700">Monday</span><span class="text-gray-900">9:00 AM - 10:00 PM</span></div>
                        <div class="flex justify-between items-center py-1" :class="currentDay === 2 ? 'bg-blue-50 px-2 rounded font-medium' : ''"><span class="text-gray-700">Tuesday</span><span class="text-gray-900">9:00 AM - 10:00 PM</span></div>
                        <div class="flex justify-between items-center py-1" :class="currentDay === 3 ? 'bg-blue-50 px-2 rounded font-medium' : ''"><span class="text-gray-700">Wednesday</span><span class="text-gray-900">9:00 AM - 10:00 PM</span></div>
                        <div class="flex justify-between items-center py-1" :class="currentDay === 4 ? 'bg-blue-50 px-2 rounded font-medium' : ''"><span class="text-gray-700">Thursday</span><span class="text-gray-900">9:00 AM - 10:00 PM</span></div>
                        <div class="flex justify-between items-center py-1" :class="currentDay === 5 ? 'bg-blue-50 px-2 rounded font-medium' : ''"><span class="text-gray-700">Friday</span><span class="text-gray-900">9:00 AM - 11:00 PM</span></div>
                        <div class="flex justify-between items-center py-1" :class="currentDay === 6 ? 'bg-blue-50 px-2 rounded font-medium' : ''"><span class="text-gray-700">Saturday</span><span class="text-gray-900">10:00 AM - 11:00 PM</span></div>
                        <div class="flex justify-between items-center py-1" :class="currentDay === 0 ? 'bg-blue-50 px-2 rounded font-medium' : ''"><span class="text-gray-700">Sunday</span><span class="text-gray-900">10:00 AM - 9:00 PM</span></div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div x-data="businessStatus()" class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full" :class="isOpen ? 'bg-green-500' : 'bg-red-500'"></div>
                            <span class="font-medium" :class="isOpen ? 'text-green-700' : 'text-red-700'" x-text="isOpen ? 'Open now' : 'Closed'"></span>
                            <span class="text-gray-600" x-text="nextChangeText"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- This entire script block is copied from the original static HTML --}}
    <script>
        function businessPage() {
            return {}
        }

        function businessStatus() {
            return {
                isOpen: false,
                nextChangeText: '',
                
                init() {
                    this.updateStatus();
                    setInterval(() => this.updateStatus(), 60000);
                },
                
                updateStatus() {
                    const now = new Date();
                    const currentDay = now.getDay();
                    const currentTime = now.getHours() * 60 + now.getMinutes();
                    
                    // Business hours (in minutes from midnight). We will make this dynamic later.
                    const hours = {
                        0: { open: 10 * 60, close: 21 * 60 }, // Sunday
                        1: { open: 9 * 60, close: 22 * 60 },  // Monday
                        2: { open: 9 * 60, close: 22 * 60 },  // Tuesday
                        3: { open: 9 * 60, close: 22 * 60 },  // Wednesday
                        4: { open: 9 * 60, close: 22 * 60 },  // Thursday
                        5: { open: 9 * 60, close: 23 * 60 },  // Friday
                        6: { open: 10 * 60, close: 23 * 60 }  // Saturday
                    };
                    
                    const todayHours = hours[currentDay];
                    if (!todayHours) {
                        this.isOpen = false;
                        this.nextChangeText = '• Closed today';
                        return;
                    }

                    this.isOpen = currentTime >= todayHours.open && currentTime < todayHours.close;
                    
                    if (this.isOpen) {
                        this.nextChangeText = `• Closes at ${this.formatTime(todayHours.close)}`;
                    } else {
                        if (currentTime < todayHours.open) {
                            this.nextChangeText = `• Opens at ${this.formatTime(todayHours.open)}`;
                        } else {
                            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                            let nextOpenDay = currentDay;
                            let attempts = 0;
                            do {
                                nextOpenDay = (nextOpenDay + 1) % 7;
                                attempts++;
                            } while (!hours[nextOpenDay] && attempts < 7);

                            if(attempts < 7) {
                                this.nextChangeText = `• Opens ${dayNames[nextOpenDay]} at ${this.formatTime(hours[nextOpenDay].open)}`;
                            } else {
                                this.nextChangeText = '• Closed indefinitely';
                            }
                        }
                    }
                },
                
                formatTime(minutes) {
                    const hours = Math.floor(minutes / 60);
                    const mins = minutes % 60;
                    const period = hours >= 12 ? 'PM' : 'AM';
                    const displayHours = hours % 12 === 0 ? 12 : hours % 12;
                    return `${displayHours}:${mins.toString().padStart(2, '0')} ${period}`;
                }
            }
        }
    </script>
@endsection
