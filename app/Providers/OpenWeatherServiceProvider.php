<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Cmfcmf\OpenWeatherMap as OpenWeatherMap ;
use Weather;
use View;
use Cache;

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

			return new OpenWeatherMap(config('services.openweather.key'), $mahmut->make('Http\Adapter\Guzzle6\Client'), $mahmut->make('Http\Factory\Guzzle\RequestFactory'));


		});

		// return new \Cmfcmf\OpenWeatherMap($mahmut->make('Illuminate\Http\Request'), "sdasddsaadsasd");

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
	public function boot(Weather $weatherServices)
	{


		$weather = Cache::remember('weather', 10, function () use ($weatherServices)
		{
		 return $weatherServices->getWeather('Bolu', 'metric', 'tr');

		});
		// $weather = $weatherServices->getWeather('Bolu', 'metric', 'tr');
		View::share('weather', $weather);
	}
}
