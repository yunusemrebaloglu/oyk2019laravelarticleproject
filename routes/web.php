<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'ArticleController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('article')->middleware('auth')->name('article.')->group(function () {

	Route::get('/new', 'ArticleController@create')->name('create');

	Route::get('/', 'ArticleController@index')->name('index');

	Route::post('/', 'ArticleController@store')->name('store');

	Route::get('/{article}', 'ArticleController@detail')->name('detail');

	Route::get('/edit/{article}', 'ArticleController@edit')->name('edit');

	Route::put('/{article}', 'ArticleController@update')->name('update');

	Route::delete('/{article}', 'ArticleController@destroy')->name('destroy');

	Route::post('/{article}/comments', 'ArticleController@addComment')->name('addComment');

	Route::get('/tags', 'ArticleController@articleIntags')->name('articleIntags');

	Route::get('/tag/{tag}', 'ArticleController@tagInArticles')->name('tagInArticles');
});


Route::prefix('user')->middleware('auth')->name('users.')->group(function () {


	Route::get('/', 'UserController@index')->name('index');
	Route::get('/comments/articles', 'UserController@commentedArticles')->name('commentedArticles');

	Route::get('/article/{user}', 'UserController@article')->name('article');

	Route::get('/profile/{user}', 'UserController@profile')->name('profile');


	Route::PUT('/profile/update/{user}', 'UserController@update')->name('update');

	Route::get('/profile/follower/{user}', 'UserController@follower')->name('follower');

	Route::get('/profile/unfollower/{user}', 'UserController@unfollower')->name('unfollower');

	Route::get('/{user}/follow/{fallow}', 'UserController@followlist')->name('followList');


	Route::get('/notification/{notification}', 'UserController@notificationRead')->name('notification');
});
