<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
// use Http\Factory\Guzzle\RequestFactory;
// use Http\Adapter\Guzzle6\Client as GuzzleAdapter;


class OpenWeatherServiceProvider extends ServiceProvider
{
	/**
	* Register services.
	*
	* @return void
	*/
	public function register()
	{

		$this->app->singleton('Cmfcmf\OpenWeatherMap', function ($mahmut){
			return new \Cmfcmf\OpenWeatherMap(config('services.openweather.key'), $mahmut->make('Http\Adapter\Guzzle6\Client'), $mahmut->make('Http\Factory\Guzzle\RequestFactory'));
			return new \Cmfcmf\OpenWeatherMap($mahmut->make('Illuminate\Http\Request'), "sdasddsaadsasd");
		});



		// $httpRequestFactory = new RequestFactory();
		// $httpClient = GuzzleAdapter::createWithConfig([]);
		//
		// $owm = new OpenWeatherMap(config('services.openweather.key'), $httpClient, $httpRequestFactory);
		//
		// $this->app->instance('Cmfcmf\OpenWeatherMap' , $owm);
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
