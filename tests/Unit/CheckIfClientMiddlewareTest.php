<?php

namespace Tests\Unit;

use App\Helpers\ConstantRoleHelper;
use App\Http\Middleware\CheckIfClientMiddleware;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckIfClientMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_client_redirected()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerSuperadminDetails())
        );

        $request = Request::create('/client/dashboard');

        $middleware = new CheckIfClientMiddleware;

        $response = $middleware->handle($request, function() {});

        $this->assertEquals($response->getStatusCode(), 302);
    }

    /** @test */
    public function client_are_not_redirected()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerClientDetails())
        );

        $request = Request::create('/client/dashboard');

        $middleware = new CheckIfClientMiddleware;

        $response = $middleware->handle($request, function() {});

        $this->assertEquals($response, null);
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

    private function registerClientDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  'password',
            'role'      =>  ConstantRoleHelper::CLIENT,
            'isFilled'  =>  false,
            'isActive'  =>  true,
        ];
    }
}
