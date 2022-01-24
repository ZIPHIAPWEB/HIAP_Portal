<?php

namespace Tests\Unit;

use App\Helpers\ConstantRoleHelper;
use App\Http\Middleware\CheckIfSuperadminMiddleware;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckIfSuperadminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_superadmin_redirected()
    {
        $this->actingAs(
            User::create($this->registerUserClientDetails())
        );

        $request = Request::create('/sa/dashboard');

        $middleware = new CheckIfSuperadminMiddleware;

        $response = $middleware->handle($request, function() {});

        $this->assertEquals($response->getStatusCode(), 302);
    }

    /** @test */
    public function superadmin_are_not_redirected()
    {
        $this->actingAs(
            User::create($this->registerSuperadminDetails())
        );

        $request = Request::create('/sa/dashboard');

        $middleware = new CheckIfSuperadminMiddleware;

        $response = $middleware->handle($request, function() {});

        $this->assertEquals($response, null);
    }

    private function registerUserClientDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  'password',
            'role'      =>  ConstantRoleHelper::CLIENT,
            'isFilled'  =>  false,
            'isActive'  =>  true,
        ];
    }

    private function registerSuperadminDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  'password',
            'role'      =>  ConstantRoleHelper::SUPERADMINISTRATOR,
            'isFilled'  =>  false,
            'isActive'  =>  true,
        ];
    }
}
