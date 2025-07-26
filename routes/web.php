<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ReviewController;

// This single route will handle our homepage.
// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
// Category Page
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Search Results
Route::get('/search', [SearchController::class, 'index'])->name('search');
// Business Detail Page
Route::get('/business/{business:slug}', [BusinessController::class, 'show'])->name('business.show');

//Review routes
Route::get('/business/{business}/review', [ReviewController::class, 'create'])
    ->middleware(['auth'])
    ->name('reviews.create');

Route::post('/business/{business}/review', [ReviewController::class, 'store'])
    ->middleware(['auth'])
    ->name('reviews.store');
// This line loads all the authentication routes (login, register, etc.)
// that Laravel Breeze created for us.
require __DIR__.'/auth.php';
