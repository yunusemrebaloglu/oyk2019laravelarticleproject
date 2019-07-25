<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;


class OpenWeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$lang = 'tr';
		$units = 'metric';

		$httpRequestFactory = new RequestFactory();
		$httpClient = GuzzleAdapter::createWithConfig([]);

		$owm = new OpenWeatherMap('3e052d0ed5425b63f9d6734870bd7cb1', $httpClient, $httpRequestFactory);

		$this->app->instance('Cmfcmf\OpenWeatherMap' , $owm);
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
