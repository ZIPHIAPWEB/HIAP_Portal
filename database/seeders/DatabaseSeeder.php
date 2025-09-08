<?php

use App\OnlineProgram;
use App\User;
use Database\Seeders\AddUpdateOnCourseTableSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\IndustrySeeder;
use Database\Seeders\ProgramTrackSeeder;
use Database\Seeders\SchoolSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [
            AddUpdateOnCourseTableSeeder::class,
            IndustrySeeder::class
        ];

        #dummy data only for non-production environment
        if (!(app()->environment('production'))) {
            $seeders = array_merge($seeders, [
                SchoolSeeder::class,
                CourseSeeder::class,
                ProgramTrackSeeder::class,
            ]);
        }

        $this->call($seeders);
    }
}
