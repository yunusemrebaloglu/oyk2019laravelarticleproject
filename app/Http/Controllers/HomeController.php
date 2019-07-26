<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Weather;

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

	public function showWeather(Weather $owm)
	{

		$weather = $owm->getWeather('Bolu', 'metric', 'tr');

		return $weather->temperature;

	}
}
