<?php

use Illuminate\Http\Request;
use App\Auth;
use App\Article;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function(){
	return response()->json(['status'=>true]);
})->name('apiBaseUrl');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('article', 'API\ArticleResourceController');

Route::Post('gettoken', function(Request $request){
	if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
	{
		return $request->user();
	}
	return response()->json(
		[
			'message' => 'Geçerli bir kullanıcı Yoktur'
		], 401
	);
});


// Get token rotasına post atıldığında dönen yanıt ilgili kişinin parametreleri olacaktır
	// Rota : gettoken
	// Parametreler: email,password

	// Response
	// 401 Yetkisiz Giriş
	// 200 Request ->user
