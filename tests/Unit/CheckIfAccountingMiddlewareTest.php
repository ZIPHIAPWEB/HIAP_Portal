<?php

namespace Tests\Unit;

use App\Helpers\ConstantRoleHelper;
use App\Http\Middleware\CheckIfAccountingMiddleware;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class CheckIfAccountingMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_accounting_redirected()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerSuperadminDetails())
        );

        $request = Request::create('/md/dashboard');

        $middleware = new CheckIfAccountingMiddleware;

        $response = $middleware->handle($request, function() {});

        $this->assertEquals($response->getStatusCode(), 302);
    }

    /** @test */
    public function accounting_are_not_redirected()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(
            User::create($this->registerAccountingDetails())
        );

        $request = Request::create('/md/dashboard');

        $middleware = new CheckIfAccountingMiddleware;

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

    private function registerAccountingDetails()
    {
        return [
            'email'     =>  'test@app.com',
            'password'  =>  'password',
            'role'      =>  ConstantRoleHelper::ACCOUNTING,
            'isFilled'  =>  false,
            'isActive'  =>  true,
        ];
    }
}
