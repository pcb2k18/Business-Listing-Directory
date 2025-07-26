<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Support\Str;

class AddNewBusinesses extends Command
{
    /**
     * The name and signature of the console command.
     * We'll use our custom name.
     * @var string
     */
    protected $signature = 'ghana-insider:add-businesses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add or update businesses from a predefined list without deleting existing data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to add/update businesses...');

        $businessData = $this->getBusinessData();

        foreach ($businessData as $categoryName => $businesses) {
            // Find or create the category
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName) . '-in-accra'] // Making the slug SEO-friendly
            );
            
            $this->info("Processing category: {$category->name}");

            foreach ($businesses as $business) {
                // Use updateOrCreate to prevent duplicates based on name and address
                $newBusiness = Business::updateOrCreate(
                    [
                        'name' => $business['name'],
                        'address_line_1' => $business['address_line_1'],
                    ],
                    [
                        'slug' => Str::slug($business['name']),
                        'description' => $business['description'] ?? null,
                        'city' => $business['city'] ?? 'Accra',
                        'state' => 'Greater Accra',
                        'zip_code' => '00233',
                        'country' => 'Ghana',
                        'phone_number' => $business['phone_number'] ?? null,
                        'website_url' => $business['website_url'] ?? null,
                        'price_range' => $business['price_range'] ?? null,
                        'ai_summary' => $business['ai_summary'] ?? null,
                    ]
                );

                // Attach the category if it's not already attached
                if (!$newBusiness->categories->contains($category->id)) {
                    $newBusiness->categories()->attach($category->id);
                }

                $this->line(" - Processed: {$business['name']}");
            }
        }

        $this->info('All businesses have been processed successfully!');
        return 0;
    }

    /**
     * This is the single source of truth for our initial business data.
     */
    private function getBusinessData(): array
    {
        return [
            'AC Repair & Installation' => [
                ['name' => 'Living electrical and Air condition service', 'address_line_1' => 'Alajo T junction Street 7', 'city' => 'Accra', 'phone_number' => '024 781 8784', 'description' => 'Expert electrical and air conditioning services for residential and commercial properties in Accra.'],
                ['name' => 'Johani Auto Cooling Limited', 'address_line_1' => 'Cornerstone St', 'city' => 'Accra', 'phone_number' => '024 057 9099', 'website_url' => 'http://johaniautocool.com', 'description' => 'A reliable service specializing in vehicle AC installation and repair, using the latest diagnostic tools.'],
                ['name' => 'EBEN COOLING TECHNOLOGY COMPANY', 'address_line_1' => 'HP3R+2WR, Nungua', 'city' => 'Accra', 'phone_number' => '054 627 2755', 'description' => 'Dedicated and timely air conditioning repair service with a focus on great customer care.'],
                ['name' => 'Geff Star Engineering Services', 'address_line_1' => 'JQ5H+26V, Pinto Rd', 'city' => 'Accra', 'phone_number' => '053 699 0765', 'description' => 'Professional engineering services for air conditioning systems in the Accra area.'],
                ['name' => 'Living air conditioning solution service', 'address_line_1' => 'Accra', 'city' => 'Accra', 'phone_number' => '024 946 1445', 'website_url' => 'https://wa.me/233249461445', 'description' => 'Providing comprehensive air conditioning solutions for customers in and around Accra.'],
            ],
            'Construction Companies' => [
                ['name' => 'Elzo Group (Construction & Information Technology)', 'address_line_1' => '13 Jungle Ave', 'city' => 'Accra', 'phone_number' => '054 474 3993', 'description' => 'A prompt and professional construction company committed to delivering quality work with incredible attention to detail.'],
                ['name' => 'Elegant Homes and General Construction Ltd', 'address_line_1' => 'QV6W+359, Unnamed Road, Amrahia', 'city' => 'Accra', 'phone_number' => '024 469 9053', 'description' => 'Specializing in home building and general construction projects in the Amrahia area.'],
                ['name' => 'Builder Project Solutions', 'address_line_1' => 'Tse Addo, Town East Centre, Mahama Road', 'city' => 'Accra', 'phone_number' => '023 538 3207', 'description' => 'A highly reliable design and build construction company providing solutions across Accra.'],
                ['name' => 'Ghana Expert Builders', 'address_line_1' => 'Awoshie - Anyaa Main Road', 'city' => 'Accra', 'phone_number' => '027 011 3728', 'description' => 'Quality custom homebuilders focused on individual client needs and family-oriented service.'],
                ['name' => 'Andoc Prestige Limited', 'address_line_1' => 'Mpehuasem', 'city' => 'Accra', 'phone_number' => '026 264 8648', 'description' => 'A prestige construction company serving Accra and nearby areas with a commitment to excellence.'],
            ],
            'Bus & Car Rentals' => [
                ['name' => 'Caradise Ghana - Car & Bus Rental (Accra)', 'address_line_1' => 'Worship Curve', 'city' => 'Accra', 'phone_number' => '024 608 6365', 'website_url' => 'http://caradiseghana.com', 'description' => 'A premier van, car, and bus rental agency serving Accra and nearby areas 24/7.'],
                ['name' => 'A1 Car and Bus Rental', 'address_line_1' => 'Cycas St', 'city' => 'Accra', 'phone_number' => '057 460 6464', 'description' => 'Corporate and private car and bus rental services located in Accra.'],
                ['name' => 'ESKEL CAR RENTALS AND LOGISTICS', 'address_line_1' => 'Kaajaano LA south U turn, opposite advert press', 'city' => 'Accra', 'phone_number' => '050 150 5808', 'website_url' => 'http://eskelcarrentalsandtours.com', 'description' => 'A reliable car rental company with superb customer service, offering rentals and tours.'],
                ['name' => 'NewBest Transport Services', 'address_line_1' => 'Accra', 'city' => 'Accra', 'phone_number' => '055 122 2151', 'description' => 'Professional transport services with amazing staff, comfortable buses, and a reputation for punctuality.'],
                ['name' => 'BE HAPPY LIMO CAR RENTALS', 'address_line_1' => '26 Westland Boulevard, Haatso', 'city' => 'Accra', 'phone_number' => '020 063 1825', 'description' => 'Providing limousine and car rental transportation services in the Haatso area.'],
            ],
            'Standardized Test Preparation (GRE, IELTS, SAT)' => [
                ['name' => 'Timeline Trust', 'address_line_1' => 'Otsaame Baako Ln, Achimota Neoplan', 'phone_number' => '026 673 3700', 'website_url' => 'http://timelinetrust.com', 'description' => 'A trusted institution for IELTS, TOEFL, SAT, GRE, and GMAT test preparation services in Accra.'],
                ['name' => 'Accra Institute of Excellence (AIE)', 'address_line_1' => 'Adenta Taxi rank opposite the total Filling Station', 'phone_number' => '024 500 6610', 'website_url' => 'https://wa.me/233245006610', 'description' => 'Educational consultants providing top-quality, friendly, and engaging tuition for IELTS and SAT exams.'],
                ['name' => 'Hillton Study Center', 'address_line_1' => 'No. 14/5 Off Ring Road East, Osu - Danquah', 'phone_number' => '054 273 1818', 'description' => 'A dedicated study center in Osu offering preparation for international examinations.'],
                ['name' => 'Global Baseline Ltd.', 'address_line_1' => 'Kwame Nkrumah Avenue, and Adama Ave', 'phone_number' => '024 407 6813', 'website_url' => 'http://globalbaseline.com', 'description' => 'Providing comprehensive support and classes for students preparing for the IELTS exam.'],
                ['name' => 'SOPODIVA Training Centre LTD. GH', 'address_line_1' => '3 Celery Madina', 'phone_number' => '054 020 1004', 'description' => 'A training centre in Madina offering a range of educational programs including IELTS preparation.'],
                ['name' => 'EXCELLENT HOME CLASSES', 'address_line_1' => '93 Brenya Ave', 'city' => 'Accra', 'phone_number' => '024 609 9277', 'website_url' => 'http://tiny.cc/ehclasses', 'description' => 'Providing 24-hour home tuition for a wide range of exams including GRE, serving all of Ghana.'],
                ['name' => 'Global Baseline', 'address_line_1' => 'Jungle Ave', 'city' => 'Accra', 'phone_number' => '030 220 0837', 'description' => 'Comprehensive test preparation services for students in Accra.'],
                ['name' => 'STANDARD HOME TUITION | IELTS/ SAT / IGCSE /A-LEVEL /IB /WASSCE /GRE', 'address_line_1' => 'Accra', 'city' => 'Accra', 'phone_number' => '020 265 1994', 'description' => 'Top-class, dedicated, and professional home tutors for a wide variety of standardized tests.'],
            ],
        ];
    }
}
