<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        	// $this->app->bind('App\Helpers\Mahmut', function ($app){
			// 	return new \App\Helpers\Mahmut($app->make('Illuminate\Http\Request'), "sdasddsaadsasd");
			// });
        	$this->app->singleton('App\Helpers\Mahmut', function ($mahmut){
				return new \App\Helpers\Mahmut($mahmut->make('Illuminate\Http\Request'), "sdasddsaadsasd");
			});

			// $mahmut = new \App\Helpers\Mahmut($app->make('Illuminate\Http\Request'), "sdasddsaadsasd");
        	// $this->app->instance('App\Helpers\Mahmut', $mahmut);



    }


}
