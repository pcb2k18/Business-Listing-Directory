@extends('layouts.app')

@section('title', "Search results for '$query' - Ghana Insider")

@section('content')
    {{-- Top Search Bar Section --}}
    <section class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            {{-- Point the form to the search route and use the GET method --}}
            <form action="{{ route('search') }}" method="GET" class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4">
                <div class="flex-1 w-full relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input
                        type="text"
                        name="what" {{-- Added name="what" --}}
                        placeholder="Search businesses..."
                        value="{{ $query }}"
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900"
                    />
                </div>
                <div class="flex items-center space-x-2 w-full sm:w-auto">
                    <div class="relative flex-1 sm:flex-none">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <input
                            type="text"
                            name="where" {{-- Added name="where" --}}
                            placeholder="Location"
                            value="{{ request('where', 'Accra') }}" {{-- Made location dynamic --}}
                            class="w-full sm:w-40 pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900"
                        />
                    </div>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors duration-200 whitespace-nowrap">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- Main Content Area --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6" x-data="{ filterOpen: false, openNow: false, selectedCategories: [], priceRange: [] }">
        
        {{-- Mobile Filter Button --}}
        {{-- ... Your Mobile Filter code is perfect, no changes needed ... --}}

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Desktop Filters (Left Column) --}}
            {{-- ... Your Desktop Filter code is perfect, no changes needed ... --}}

            {{-- Results (Right Column) --}}
            <main class="flex-1">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Showing {{ $businesses->total() }} results for '{{ $query }}'
                    </h2>
                </div>

                {{-- Results Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    {{-- Changed to @forelse for better empty state handling --}}
                    @forelse ($businesses as $business)
                        <a href="{{ route('business.show', $business) }}" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 flex flex-col">
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="https://images.pexels.com/photos/260922/pexels-photo-260922.jpeg?auto=compress&cs=tinysrgb&w=800&h=450" alt="{{ $business->name }}" class="w-full h-48 object-cover" />
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $business->name }}</h3>
                                
                                <div class="flex items-center mb-2">
                                    {{-- Placeholder for rating --}}
                                </div>

                                <p class="text-sm text-gray-700 mb-2">
                                    {{ $business->categories->first()?->name ?? 'Uncategorized' }} • {{ $business->price_range ?? '' }}
                                </p>

                                {{-- Pushes address to the bottom of the card --}}
                                <div class="mt-auto">
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $business->address_line_1 }}, {{ $business->city }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        {{-- This shows if there are no results --}}
                        <div class="md:col-span-2 xl:col-span-3 text-center py-12">
                            <p class="text-gray-600 text-lg">No businesses found matching your search.</p>
                            <a href="{{ route('home') }}" class="text-blue-600 hover:underline mt-2 inline-block">Go back to homepage</a>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{-- Append the original query to pagination links --}}
                    {{ $businesses->withQueryString()->links() }}
                </div>
            </main>
        </div>
    </div>
@endsection
