<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('description')->nullable();
            $table->string('address_line_1');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website_url')->nullable();
            $table->string('google_place_id')->unique()->nullable();
            $table->json('google_opening_hours')->nullable();
            $table->string('google_maps_url')->nullable();
            $table->string('price_range', 4)->nullable();

            // This is the new line you are adding
            $table->text('ai_summary')->nullable();

            $table->boolean('is_verified')->default(false);
            $table->string('status')->default('active');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
