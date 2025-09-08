<?php

namespace Database\Seeders;

use App\OnlineProgram;
use Illuminate\Database\Seeder;

class OnlineProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            'name'          => 'Flex IP',
            'display_name'  => 'Flex IP'
        ];

        foreach ($programs as $program) {
            OnlineProgram::create($program);
        }
    }
}
