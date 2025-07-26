@extends('layouts.app')

{{-- Push the ItemList schema into the <head> --}}
@push('head')
    {!! $schema !!}
@endpush

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            {{-- Use the dynamic category name from the controller --}}
            <h1 class="text-4xl md:text-5xl font-bold mb-4">List of {{ $category->name }} in Accra</h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Find the nearest {{ $category->name }} in Accra. Real Places, Real Reviews. Get the best recommendations on Ghana Insider.
            </p>
        </div>
    </div>

    <!-- Business List Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Results Summary -->
        <div class="mb-8">
            <p class="text-gray-600 text-lg">
                {{-- Use the paginator's total() method for an accurate count --}}
                <span class="font-semibold text-gray-900">{{ $businesses->total() }} results</span> found for {{ $category->name }} in Accra
            </p>
        </div>

        <!-- Business Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse ($businesses as $business)
                <a href="{{ route('business.show', $business) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=500" 
                         alt="{{ $business->name }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $business->name }}</h3>
                        
                        {{-- We will add dynamic rating here later --}}
                        <div class="flex items-center mb-3">
                            <span class="text-sm text-gray-600">(No reviews yet)</span>
                        </div>

                        <p class="text-sm text-gray-600 mb-2">{{ $category->name }} • {{ $business->price_range ?? '' }}</p>
                        <p class="text-sm text-gray-500">{{ $business->address_line_1 }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                    <p class="text-gray-600 text-lg">No businesses found in this category yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Section -->
        <div>
            {{-- This single line renders the pagination links and keeps query strings --}}
            {{ $businesses->links() }}
        </div>
    </div>
@endsection
