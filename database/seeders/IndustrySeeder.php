<?php

namespace Database\Seeders;

use App\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::create([
            [
                'name' => 'Hospitality',
                'description' => 'Hospitality',
                'is_active' => 1
            ],
            [
                'name' => 'Tourism',
                'display_name' => 'Tourism',
                'is_active' => 1
            ],
            [
                'name' => 'Food Service',
                'display_name' => 'Food Service',
                'is_active' => 1
            ],
            [
                'name' => 'Education Institutions',
                'display_name' => 'Education Institutions',
                'is_active' => 1
            ],
            [
                'name' => 'Cruise Line and Airline Retail',
                'display_name' => 'Cruise Line and Airline Retail',
                'is_active' => 1
            ],
            [
                'name' => 'Business Processing',
                'display_name' => 'Business Processing',
                'is_active' => 1
            ]
        ]);
    }
}
