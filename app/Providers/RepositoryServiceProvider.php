<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

use App\Interfaces\BalldontliesTeamsRepositoryInterface;
use App\Repositories\BalldontliesTeamsRepository;

use App\Interfaces\PersonalUserTokenRepositoryInterface;
use App\Repositories\PersonalUserTokenRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BalldontliesTeamsRepositoryInterface::class, BalldontliesTeamsRepository::class);
        $this->app->bind(PersonalUserTokenRepositoryInterface::class, PersonalUserTokenRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
