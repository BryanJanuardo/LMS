<?php

namespace App\Providers;

use App\Events\NewAnnouncement;
use App\Listeners\SendAnnouncement;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrap();

        Gate::define('admin', function(User $user) {
            return $user->roleid === '1';
        });

        Gate::define('user', function(User $user){
            return Auth::check();
        });

        Event::listen(
            NewAnnouncement::class,
            SendAnnouncement::class
        );
    }
}
