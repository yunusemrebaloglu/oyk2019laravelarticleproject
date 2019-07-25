<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;



class HomeController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth')->only('index');
	}

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function index(Request $request)
	{

		$articles = $request->user()->articles;
		// dd($articles);
		return view('home', compact('articles'));
	}

	public function showWeather(\Cmfcmf\OpenWeatherMap $owm)
	{

		$weather = $owm->getWeather('Bolu', 'metric', 'tr');

		return $weather->temperature;

	}
}
