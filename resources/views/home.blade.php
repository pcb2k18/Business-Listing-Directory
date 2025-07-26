{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

{{-- You can set a custom title for this specific page for SEO --}}
@section('title', 'Ghana Insider - Find Your Next Favorite Spot in Ghana')
@section('description', 'Discover verified local businesses in Ghana with AI-powered insights. Find restaurants, services, and attractions near you.')

@section('content')
    <!-- Hero Section -->
{{-- resources/views/home.blade.php --}}

<!-- Hero Section -->
<section class="relative bg-cover bg-center px-4 py-12 sm:py-20 lg:py-24" style="background-image: url('/images/hero-background.jpg');">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    
    <div class="relative max-w-4xl mx-auto text-center">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-md">
            Find Your Next Favorite Spot in <span class="text-primary-100">Ghana</span>
        </h1>
        <p class="text-lg sm:text-xl text-primary-50 mb-8 max-w-2xl mx-auto drop-shadow-md">
            Discover verified local businesses with AI-powered insights and authentic reviews from fellow Ghanaians.
        </p>

        <!-- Search Form -->
        <form action="/search" method="GET" class="bg-white rounded-xl shadow-lg p-4 max-w-3xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                {{-- "What" Input --}}
                <div class="flex-1 mb-4 md:mb-0">
                    <label for="search-what" class="sr-only">What are you looking for?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" id="search-what" name="what" placeholder="What are you looking for? (e.g., jollof, salon)" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-500">
                    </div>
                </div>
                
                {{-- "Where" Input --}}
                <div class="flex-1 mb-4 md:mb-0">
                    <label for="search-where" class="sr-only">Where?</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <input type="text" id="search-where" name="where" placeholder="Accra, Ghana" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-500">
                    </div>
                </div>

                {{-- The Search Button --}}
                <div class="flex-shrink-0">
                    <button type="submit" class="w-full md:w-auto bg-primary-600 text-white py-3 px-6 rounded-lg hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 font-semibold text-lg transition-colors">
                        Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
      <!-- Categories Section -->
        <section class="px-4 py-12 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 text-center mb-8">Explore Categories</h2>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                   @foreach ($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="group flex flex-col items-center p-4 sm:p-6 bg-gray-50 rounded-xl hover:bg-primary-50 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
            {{-- For now, we use a placeholder icon. Later you can store the SVG in the database --}}
            <svg class="h-8 w-8 sm:h-10 sm:w-10 text-accent-500 group-hover:text-accent-600 mb-3" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
            </svg>
            <span class="text-sm sm:text-base font-medium text-gray-900 text-center">{{ $category->name }}</span>
        </a>
    @endforeach
                </div>
            </div>
        </section>

 <!-- Popular Near You Section -->
        <section class="px-4 py-12 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 text-center mb-8">Popular Near You</h2>
                
                <div class="flex space-x-4 overflow-x-auto pb-4 scrollbar-hide">
                  @foreach ($trendingBusinesses as $business)
        <a href="{{ route('business.show', $business) }}" class="flex-none w-72 bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            <img src="{{ $business->featured_image_url ?? 'https://images.pexels.com/photos/302899/pexels-photo-302899.jpeg?auto=compress&cs=tinysrgb&w=400' }}" alt="Exterior of {{ $business->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-semibold text-lg text-gray-900 mb-2 truncate">{{ $business->name }}</h3>
                {{-- We will add dynamic rating later --}}
                <div class="flex items-center mb-2"> ... </div>
                <p class="text-gray-600 text-sm">{{ $business->categories->first()?->name ?? 'Category' }} • {{ $business->price_range ?? '₵₵' }}</p>
            </div>
        </a>
    @endforeach
                </div>
            </div>
        </section>
@endsection
