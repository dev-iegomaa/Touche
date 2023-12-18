<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\Web\Admin\AdminInterface',
            'App\Http\Repositories\Web\Admin\AdminRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\Admin\ChefInterface',
            'App\Http\Repositories\Web\Admin\ChefRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\Admin\MealInterface',
            'App\Http\Repositories\Web\Admin\MealRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\Admin\CategoryInterface',
            'App\Http\Repositories\Web\Admin\CategoryRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\Admin\MenuInterface',
            'App\Http\Repositories\Web\Admin\MenuRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\Admin\AuthInterface',
            'App\Http\Repositories\Web\Admin\AuthRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\Admin\ContactInterface',
            'App\Http\Repositories\Web\Admin\ContactRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\EndUser\EndUserInterface',
            'App\Http\Repositories\Web\EndUser\EndUserRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Web\EndUser\EndUserAuthInterface',
            'App\Http\Repositories\Web\EndUser\EndUserAuthRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\Admin\ApiCategoryInterface',
            'App\Http\Repositories\Api\Admin\ApiCategoryRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\Admin\ApiMealInterface',
            'App\Http\Repositories\Api\Admin\ApiMealRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\Admin\ApiChefInterface',
            'App\Http\Repositories\Api\Admin\ApiChefRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\Admin\ApiMenuInterface',
            'App\Http\Repositories\Api\Admin\ApiMenuRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\Admin\ApiContactUsInterface',
            'App\Http\Repositories\Api\Admin\ApiContactUsRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\EndUser\ApiUserInterface',
            'App\Http\Repositories\Api\EndUser\ApiUserRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\Admin\ApiAuthInterface',
            'App\Http\Repositories\Api\Admin\ApiAuthRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\EndUser\ApiEndUserAuthInterface',
            'App\Http\Repositories\Api\EndUser\ApiEndUserAuthRepository',
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\EndUser\ApiAuthEndUserInterface',
            'App\Http\Repositories\Api\EndUser\ApiAuthEndUserRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
