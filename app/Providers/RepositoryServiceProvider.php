<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

use App\Interfaces\Balldontlie\BalldontlieTeamRepositoryInterface;
use App\Repositories\Balldontlie\BalldontlieTeamRepository;

use App\Interfaces\PersonalUserTokenRepositoryInterface;
use App\Repositories\PersonalUserTokenRepository;

use App\Interfaces\Balldontlie\BalldontliePlayerRepositoryInterface;
use App\Repositories\Balldontlie\BalldontliePlayerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BalldontlieTeamRepositoryInterface::class, BalldontlieTeamRepository::class);
        $this->app->bind(PersonalUserTokenRepositoryInterface::class, PersonalUserTokenRepository::class);
        $this->app->bind(BalldontliePlayerRepositoryInterface::class, BalldontliePlayerRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
