<?php

namespace Database\Seeders;

use App\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools = [
            'name' => 'HIAP',
            'display_name' => 'HIAP',
        ];

        School::create($schools);
    }
}
