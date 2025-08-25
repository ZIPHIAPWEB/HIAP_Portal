<?php

use App\OnlineProgram;
use App\User;
use Database\Seeders\AddUpdateOnCourseTableSeeder;
use Database\Seeders\IndustrySeeder;
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
        $this->call([
            AddUpdateOnCourseTableSeeder::class,
            SchoolSeeder::class,
            IndustrySeeder::class
        ]);
    }
}
