<?php

namespace App\Providers;

use App\Announcement;
use App\Comment;
use App\Post;
use App\University;
use App\User;
use Illuminate\Support\Facades\View;
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
        View::share('user',User::all());
        View::share('university',University::all());
        View::share('announcement',Announcement::all());
        View::share('posts',Post::all());
    }
}
