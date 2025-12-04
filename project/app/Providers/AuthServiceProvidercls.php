<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvidercls extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('create-article', function ($user) {
            return $user->is_admin === false;
        });

        Gate::define('delete-article', function ($user, Article $article) {
            if ($user->is_admin) {
                return true;
            }

            return $article->user_id === $user->id;
        });
    }
}
