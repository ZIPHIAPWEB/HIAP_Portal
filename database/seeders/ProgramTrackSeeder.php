<?php

namespace Database\Seeders;

use App\Course;
use App\Program;
use Illuminate\Database\Seeder;

class ProgramTrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trackToSeedCount = 10;

        for ($i=0; $i < $trackToSeedCount; $i++) { 
            Program::create([
                'name' => 'Track #' . $i,
                'description' => 'Track #' . $i . ' Description',
                'course_id' => Course::inRandomOrder()->value('id'),
                'isActive' => 1
            ]);
        }

    }
}
