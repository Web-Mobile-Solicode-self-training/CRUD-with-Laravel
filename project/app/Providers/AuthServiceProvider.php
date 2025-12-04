<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create-article', function ($user) {
            // Only Authors (is_admin = false) can create
            return $user->is_admin === false;
        });


        Gate::define('delete-article', function ($user, Article $article) {
            // Admins can delete anything
            if ($user->is_admin) {
                return true;
            }

            // Authors can only delete their own articles
            return $article->user_id === $user->id;
        });
    }
}