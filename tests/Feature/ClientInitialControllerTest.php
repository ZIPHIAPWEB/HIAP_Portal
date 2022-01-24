<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ClientInitialControllerTest extends TestCase
{
    /** @test */
    public function can_store_client_initial_requirements()
    {
        $this->withoutExceptionHandling();
        
        $user = User::create($this->registerUserDetails());

        $this->actingAs($user);

        $request = $this->post('/storeClientInitialRequirements', []);

        $request->assertOk();
    }

    private function registerUserDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  Hash::make('password'),
            'role'      =>  'client',
            'isFilled'  =>  false,
            'isActive'  =>  true,
            'program_id'=>  1
        ];
    }
}
