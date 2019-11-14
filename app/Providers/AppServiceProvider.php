<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repository = [
            'LipstickBrand',
            'LipstickDetail',
            'LipstickColor',
<<<<<<< Updated upstream
            'User',
            'FavoriteLipstick',
            'Log'
=======
            'Review'
>>>>>>> Stashed changes
        ];
        foreach($repository as $repo){
            $this->app->bind('App\Repositories\\'.$repo.'RepositoryInterface','App\Repositories\\'.$repo.'Repository');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
