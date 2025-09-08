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
        $industries = [
            [
                'name' => 'Hospitality',
                'description' => 'Hospitality',
                'is_active' => 1
            ],
            [
                'name' => 'Tourism',
                'description' => 'Tourism',
                'is_active' => 1
            ],
            [
                'name' => 'Food Service',
                'description' => 'Food Service',
                'is_active' => 1
            ],
            [
                'name' => 'Education Institutions',
                'description' => 'Education Institutions',
                'is_active' => 1
            ],
            [
                'name' => 'Cruise Line and Airline Retail',
                'description' => 'Cruise Line and Airline Retail',
                'is_active' => 1
            ],
            [
                'name' => 'Business Processing',
                'description' => 'Business Processing',
                'is_active' => 1
            ]
        ];

        foreach ($industries as $industry) {
            Industry::create($industry);
        }
    }
}
