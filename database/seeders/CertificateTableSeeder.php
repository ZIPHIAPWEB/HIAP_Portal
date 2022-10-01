<?php

namespace Database\Seeders;

use App\Certificate;
use Illuminate\Database\Seeder;

class CertificateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Certificate::factory()->count(100)->create();
    }
}
