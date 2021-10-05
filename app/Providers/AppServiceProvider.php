<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define("is_admin", fn(User $user) => $user->role === "admin");
        Gate::define("is_student", fn(User $user) => $user->role === "student");
        Gate::define("is_teacher", fn(User $user) => $user->role === "teacher");
    }
}
