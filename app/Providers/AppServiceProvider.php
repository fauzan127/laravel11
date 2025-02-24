<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
        Model::preventLazyLoading();
      
        View::share('latestPosts', Post::latest()->take(5)->get());

        Gate::define('admin', function(User $user){
            return $user->is_admin;
        });
    }
    
    
}
