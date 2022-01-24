<?php

namespace Tests\Unit;

use App\Helpers\ConstantRoleHelper;
use App\Http\Middleware\CheckIfModeratorMiddleware;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckIfModeratorMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_moderator_redirected()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerSuperadminDetails())
        );

        $request = Request::create('/md/dashboard');

        $middleware = new CheckIfModeratorMiddleware;

        $response = $middleware->handle($request, function() {});

        $this->assertEquals($response->getStatusCode(), 302);
    }

    /** @test */
    public function moderator_are_not_redirected()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerModeratorDetails())
        );

        $request = Request::create('/md/dashboard');

        $middleware = new CheckIfModeratorMiddleware;

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

    private function registerModeratorDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  'password',
            'role'      =>  ConstantRoleHelper::MODERATOR,
            'isFilled'  =>  false,
            'isActive'  =>  true,
        ];
    }
}
