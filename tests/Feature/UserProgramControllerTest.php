<?php

namespace Tests\Feature;

use App\Exceptions\UserProgramIsAlreadyLinkedException;
use App\Payment;
use App\User;
use App\UserProgram;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProgramControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_user_program()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $newProgramRequest = [
            'program_id'    =>  1,
            'courses'       =>  [0 => ['id' => 1]],
            'start_date'    =>  '1/11/2022',
            'end_date'      =>  '1/11/2022',
            'hours_needed'  =>  '400',
            'application_status'    =>  'New Learner'
        ];

        $response = $this->post('/addNewProgram', $newProgramRequest);

        $this->assertDatabaseCount('user_programs', 1);
    }

    public function can_update_user_program()
    {
        $this->actingAs(User::create($this->registerUserDetails()));

        $newProgramRequest = [
            'program_id'    =>  1,
            'courses'       =>  [0 => ['id' => 1]],
            'start_date'    =>  '1/11/2022',
            'end_date'      =>  '1/11/2022',
            'hours_needed'  =>  '400',
            'application_status'    =>  'New Learner'
        ];

        
    }

    /** @test */
    public function can_delete_user_program()
    {        
        $this->actingAs(User::create($this->registerUserDetails()));
        
        $newProgramRequest = [
            'program_id'    =>  1,
            'courses'       =>  [0 => ['id' => 1]],
            'start_date'    =>  '1/11/2022',
            'end_date'      =>  '1/11/2022',
            'hours_needed'  =>  '400',
            'application_status'    =>  'New Learner'
        ];

        $newProgram = UserProgram::create($newProgramRequest);

        $response = $this->delete('/deleteUserProgram/' . $newProgram->id);

        $this->assertDatabaseCount('user_programs', 0);
    }

    /** @test */
    public function can_throw_exception_response_if_user_program_is_linked_to_payment()
    {
        $this->actingAs(User::create($this->registerUserDetails()));
        
        $newProgramRequest = [
            'program_id'    =>  1,
            'courses'       =>  [0 => ['id' => 1]],
            'start_date'    =>  '1/11/2022',
            'end_date'      =>  '1/11/2022',
            'hours_needed'  =>  '400',
            'application_status'    =>  'New Learner'
        ];

        $newProgram = UserProgram::create($newProgramRequest);

        $newPayment = [
            'course_id' =>  $newProgram->id,
            'purpose'   =>  'test',
            'path'      =>  'teset',
            'isVerified'=>  false
        ];

        Payment::create($newPayment);

        $response = $this->delete('/deleteUserProgram/' . $newProgram->id);
        
        $response->assertJson([
            'errors'    =>  [
                'message'   =>  'User program is linked to a payment'
            ],
            'status'    =>  '401'
        ]);
    }

    private function registerUserDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  'password',
            'role'      =>  'client',
            'isFilled'  =>  false,
            'isActive'  =>  true,
            'program_id'=>  1
        ];
    }
}
