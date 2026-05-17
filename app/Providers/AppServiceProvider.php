<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('layouts.admin', function ($view) {
            $resetRequests = \App\Models\User::where('reset_password_requested', true)->get();
            $notificationCount = $resetRequests->count();

            $view->with([
                'resetRequests' => $resetRequests,
                'notificationCount' => $notificationCount,
            ]);
        });
    }
}
