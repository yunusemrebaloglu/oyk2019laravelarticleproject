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
// Route::get('/home', 'ArticleController@index')->name('home');

Route::get('/articles/new', 'ArticleController@create')->middleware('auth')->name('article.create');

Route::get('/articles', 'ArticleController@index')->name('article.index');

Route::post('/articles', 'ArticleController@store')->middleware('auth')->name('article.store');

Route::get('/articles/{article}', 'ArticleController@detail')->name('article.detail');

Route::get('/articles/edit/{article}', 'ArticleController@edit')->middleware('auth')->name('article.edit');

Route::put('/articles/{article}', 'ArticleController@update')->middleware('auth')->name('article.update');

Route::delete('/articles/{article}', 'ArticleController@destroy')->middleware('auth')->name('article.destroy');

Route::post('articles/{article}/comments', 'ArticleController@addComment')->name('articles.addComment')->middleware('auth');

Route::get('/users', 'UserController@index')->name('users.index');

Route::get('/users/article/{user}', 'UserController@article')->name('users.article');

Route::get('tag/{tag}/articles', 'ArticleController@tagInArticles')->name('article.tagInArticles');

Route::get('article/tags', 'ArticleController@articleIntags')->name('article.articleIntags');
