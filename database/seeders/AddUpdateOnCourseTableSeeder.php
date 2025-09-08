<?php

namespace Database\Seeders;

use App\OnlineProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddUpdateOnCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $this->updateProfessionalCertificateProgramToSpecializedIndustryProgram();
            $this->addCertificateInHospitalityManagementProgram();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e; // Re-throw the exception to handle it in the calling context
        }
    }

    private function updateProfessionalCertificateProgramToSpecializedIndustryProgram()
    {
        $course = OnlineProgram::where('name', 'Professional Certificate Program')->first();

        if ($course) {
            $course->name = 'Specialized-Industry Program';
            $course->display_name = 'Specialized-Industry Program';
            $course->save();
        }
    }

    private function addCertificateInHospitalityManagementProgram()
    {
        OnlineProgram::create([
            'name' => 'Certificate in Hospitality Management',
            'display_name' => 'Certificate in Hospitality Management',
            'is_active' => true,
        ]);
    }
}
