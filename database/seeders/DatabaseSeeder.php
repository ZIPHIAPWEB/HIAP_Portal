<?php

use App\OnlineProgram;
use App\User;
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
        // User::create([
        //     'email'     =>  'superadmin@hiap.com',
        //     'password'  =>  Hash::make('hiaprocks5000!'),
        //     'isFilled'  =>  true,
        //     'role'      =>  'superadministrator'
        // ]);

        // OnlineProgram::create([
        //     'name'          => 'Flex IP',
        //     'display_name'  => 'Flex IP'
        // ]);

        $this->call([
            SchoolSeeder::class,
            IndustrySeeder::class
        ]);
    }
}
