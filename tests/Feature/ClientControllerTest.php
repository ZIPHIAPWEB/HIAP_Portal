<?php

namespace Tests\Feature;

use App\Client;
use App\OnlineProgram;
use App\School;
use App\User;
use App\UserProgram;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function can_validate_auth_on_visiting_application_form_page()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerUserDetails())
        );

        $response = $this->get('/client/application-form');
        
        $response->assertOk();

        $this->assertAuthenticated();
    }

    /** @test */
    public function can_submit_application()
    {        
        $this->withoutExceptionHandling();
        $this->actingAs(
            User::create($this->registerUserDetails())
        );

        OnlineProgram::create([
            'name'  =>  'Program',
            'display_name'  =>  'Program'
        ]);

        School::create([
            'name'  =>  'School',
            'display_name'  =>  'jkfdlsjlkfj'
        ]);

        $response = $this->post('/client/sendApplication', $this->applicationDetails());

        $this->assertDatabaseCount('clients', 1);
    }

    /** @test */
    public function can_get_logged_client_details()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerUserDetails())
        );

        $response = $this->get('/getLoggedClientDetails');

        $response->assertOk();
        
    }

    /** @test */
    public function can_get_all_clients_details()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerUserDetails())
        );

        $response = $this->get('/getAllClientDetails');

        $response->assertOk();
    }

    /** @test */
    public function can_update_client_details()
    {
        $user = User::create($this->registerUserDetails());
        
        $this->actingAs($user);

        Client::create(array_merge($this->applicationDetails(), ['user_id' => $user->id]));

        $response = $this->post('/updateClientDetails', array_merge($this->updatedDetails(), ['user_id' => $user->id]));

        $this->assertDatabaseHas('clients', $this->updatedDetails());
    }

    /** @test */
    public function can_manual_verify_selected_client()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerUserDetails())
        );

        $response = $this->post('/setToVerified/1');

        $response->assertRedirect();
    }

    /** @test */
    public function can_unfilled_selected_client()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerUserDetails())
        );

        $response = $this->post('/setToUnfilled/1');

        $response->assertRedirect();
    }

    /** @test */
    public function can_filled_selected_client()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerUserDetails())
        );

        $response = $this->post('/setToFilled/1');
        
        $response->assertRedirect();
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

    private function applicationDetails()
    {
        return [
            'first_name'        =>  'Test',
            'middle_name'       =>  'Test',
            'last_name'         =>  'Test',
            'address'           =>  'Test Address',
            'contact_number'    =>  '09123456789',
            'school'            =>  '1',
            'alternate_email'   =>  'test1@app.com',
            'course_id'         =>  [0 => ['id' => 1]],
            'fb_link'           =>  'sdfjskldfjsdlk',
            'school_year'       =>  'fsdfsd',
            'course'            =>  'jklfsjdljfds',
            'start_date'        =>  '2022-01-06',
            'end_date'          =>  '2022-01-06',
            'hours_needed'      =>  '400',
            'expected_graduation'   =>  'February 2022'
        ];
    }

    private function updatedDetails() 
    {
        return [
            'first_name'            =>  'first_name',
            'middle_name'           =>  'middle_name',
            'last_name'             =>  'last_name',
            'address'               =>  'address',
            'course'                =>  'course',
            'school_year'           =>  'school_year',
            'contact_no'            =>  'contact_no',
            'school_id'             =>  'school_id',
            'course'                =>  'course',
            'fb_link'               =>  'fb_link',
            'program_id'            =>  'program_id',
            'alternate_email'       =>  'alternate_email',
            'expected_graduation'   =>  'February 2022'
        ];
    }
}
