<?php

namespace Database\Factories;

use App\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Certificate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cert_no'       =>  $this->faker->phoneNumber,
            'name'          =>  $this->faker->name,
            'school'        =>  $this->faker->name,
            'program'       =>  $this->faker->name,
            'total_grade'   =>  90,
            'gold_medal'    =>  1,
            'silver_medal'  =>  2,
            'bronze_medal'  =>  3,
            'total_medal'   =>  6,
            'proficiency'   =>  1
        ];
    }
}
