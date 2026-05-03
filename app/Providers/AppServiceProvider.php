<?php

namespace App\Providers;

use App\Models\Friend;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
    // URL::forceScheme('https');
      if (App::environment('production')) {
        URL::forceScheme('https');
      }

      View::composer('*', function ($view) {
        if (!Auth::check()) return;

        $userId = Auth::id();

        $friends = Friend::where('status', 'accepted')
          ->where(function ($q) use ($userId) {
            $q->where('user_id', $userId)
              ->orWhere('friend_id', $userId);
          })
          ->with(['user', 'friend'])
          ->get()
          ->map(function ($f) use ($userId) {
            return $f->user_id === $userId ? $f->friend : $f->user;
          });

        $view->with('friends', $friends);
      });
    }
}
