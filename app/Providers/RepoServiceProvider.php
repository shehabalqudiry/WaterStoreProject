<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(
            'App\RepoInterface\Users\UserInterface',
            'App\Repository\Users\UserRepository'
        );

        app()->bind(
            'App\RepoInterface\Users\ChatInterface',
            'App\Repository\Users\ChatRepository'
        );

        app()->bind(
            'App\RepoInterface\Sports\SportInterface',
            'App\Repository\Sports\SportRepository'
        );

        app()->bind(
            'App\RepoInterface\Videos\VideoInterface',
            'App\Repository\Videos\VideoRepository'
        );


        app()->bind(
            'App\RepoInterface\Store\CompanyInterface',
            'App\Repository\Store\CompanyRepository'
        );

        app()->bind(
            'App\RepoInterface\Store\ProductInterface',
            'App\Repository\Store\ProductRepository'
        );

        app()->bind(
            'App\RepoInterface\Store\OrderInterface',
            'App\Repository\Store\OrderRepository'
        );

        app()->bind(
            'App\RepoInterface\APIs\AuthInterface',
            'App\Repository\APIs\AuthRepository'
        );

        app()->bind(
            'App\RepoInterface\APIs\UserAPIOperations\ProfileAPIInterface',
            'App\Repository\APIs\UserAPIOperations\ProfileAPIRepository'
        );

        app()->bind(
            'App\RepoInterface\APIs\UserAPIOperations\OrderAPIInterface',
            'App\Repository\APIs\UserAPIOperations\OrderAPIRepository'
        );

        app()->bind(
            'App\RepoInterface\APIs\GeneralAPIInterface',
            'App\Repository\APIs\GeneralAPIRepository'
        );

        app()->bind(
            'App\RepoInterface\APIs\ChatAPIInterface',
            'App\Repository\APIs\ChatAPIRepository'
        );

        app()->bind(
            'App\RepoInterface\APIs\StoreAPIInterface',
            'App\Repository\APIs\StoreAPIRepository'
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