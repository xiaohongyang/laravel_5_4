<?php

namespace App\Providers;

use App\Models\Article;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use App\Policies\ArticlePolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       'App\Model' => 'App\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Passport
        Passport::routes();
        // Set Token Expire
        Passport::tokensExpireIn(Carbon::now()->addDay(15));
        // Refresh Token
        Passport::refreshTokensExpireIn(Carbon::now()->addDay(30));
    }
}
