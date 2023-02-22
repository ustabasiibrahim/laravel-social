<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Channel;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Post;
use App\Policies\ChannelPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CountryPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Channel::class => ChannelPolicy::class,
        Country::class => CountryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::ignoreRoutes();
    }
}
