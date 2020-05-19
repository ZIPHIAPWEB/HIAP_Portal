<?php

namespace App\Providers;

use App\Moderator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);

        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message'),
            ];
        });

        Inertia::share('auth', function () {
            if (Auth::user()) {
                if (Auth::user()->role == 'moderator') {
                    $moderator = Moderator::where('user_id', Auth::user()->id)->first();
                    return [
                        'first_name' => $moderator->first_name,
                        'last_name' => $moderator->last_name,
                    ];
                }
            }
        });
    }
}
