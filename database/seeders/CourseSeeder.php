<?php

namespace Database\Seeders;

use App\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxCoursesToSeed = 10;

        for ($i=0; $i < $maxCoursesToSeed; $i++) { 
            $name = 'Course #' . $i;
            
            Course::create([
                'name' => $name,
                'display_name' => $name
            ]);
        }
    }
}
