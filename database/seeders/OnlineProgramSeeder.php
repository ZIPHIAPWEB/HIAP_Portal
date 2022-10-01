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
        OnlineProgram::create([
            'name'          => 'Testing',
            'display_name'  => 'Testing'
        ]);
    }
}
