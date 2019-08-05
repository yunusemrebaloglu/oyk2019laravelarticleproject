<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ArticleComment;
use App\Events\ArticleCommentCreated;
use App\Http\Controllers\Controller;
use Gate;

class ArticleResourceController extends Controller
{

	public function __construct()
	{
		// $this->middleware('auth:api');
		return $this->middleware('auth:api')->except(['index', 'show']);
	}

	public function index(Article $article,Request $request)
	{
		$sort = $request->sort;
		$paginate = $request->paginate;
		if (isset($request->paginate) and isset($request->sort) ) {
			$articles = $article->$sort()->paginate($paginate);
			return response()->json(['İstenilen İçerikler'=>$articles,'message' => 'İndex İşlemi Gerçekleşmiştir.'],200);
		}else {
			return response()->json(['message' => 'İndex İşleminde Hata Var. Gerekli Paremetreler Eksik Olabilir.'],400);

		}
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' 	=> 'string|required',
			'content' 	=> 'string|required',
			'tags' 		=> 'string|nullable',
			'photo' 	=> 'image|required'
		]);
		// $path = Storage::putFile('articlePhoto', $request->file('photo'));
		// dd($path);
		// $user = Auth::where('api_token',)->get();
		$article = new Article;
		$article->user_id = $request->user()->id;
		$article->title = $request->input("title");
		$article->content = $request->input("content");
		$path = $request->file('photo')->store('public/app/articlePhoto');
		$article->image_address = $path;
		$article->save();
		if ($request->tags) {
			$tags = explode(',', $request->tags);
			$newtag = [];
			// dd($tags);
			foreach ($tags as $tag) {
				if ($tag !="") {
					$t = Tag::firstOrCreate(['tag' => $tag]);
					$newtag[] = $t->id;

				}
				// $article->tags()->attach($t);
			}
			$article->tags()->sync($newtag);
		}
		if ($article) {
			return response()->json(['Kayıt Edilen İçerik'=>$article,'message' => 'Kayıt İşlemi Gerçekleşmiştir.'],201);
		}
		return response()->json(['message' => 'Kayıt İşleminde Hata Var. Gerekli Paremetreler Eksik Olabilir.'],400);
	}

	public function show($article)
	{
		$article = Article::find($article);
		if ($article) {
			return response()->json(['İstenilen İçerik'=>$article,'message' => 'Show İşlemi Gerçekleşmiştir.'],200);
		}
		return response()->json(['message' => 'Aradığınız Article Bulunamadı'],404);

	}

	public function update(Request $request, $article)
	{
		if ($request->user()->cant('update',$article)) return abort(403);
		
		$article = Article::find($article);

		if ($article) {

			if ($article->user->id !== request()->user()->id) response()->json(['message' => 'Yetkiniz Yoktur'],401);
			$request->validate([
				'title' 	=> 'string|required',
				'content' 	=> 'string|required',
				'tags' 		=> 'string|nullable',
			]);
			$article->user_id = $request->user()->id;
			$article->title = $request->input("title");
			$article->content = $request->input("content");
			$article->save();

			$newtag = [];
			if ($request->tags) {
				$tags = explode(',', $request->tags);
				// dd($tags);
				foreach ($tags as $tag) {
					if ($tag !="") {
						$t = Tag::firstOrCreate(['tag' => $tag]);
						$newtag[] = $t->id;
					}
				}
			}

			$article->tags()->sync($newtag);

			return response()->json(['Güncellenen İçerik'=>$article,'message' => 'Güncellenme İşlemi Gerçekleşmiştir.'],200);
		}else {

			return response()->json(['message' => 'Geçerli Bir Article Yoktur'],404);
		}
	}

	public function destroy($article)
	{
		if (!Gate::allow('update-article', $article)) return abort(403);

		$article = Article::find($article);
		if ($article) {
			if ($article->user->id !== request()->user()->id) response()->json(['message' => 'Yetkiniz Yoktur'],401);

			$article->delete();
			return response()->json(['message' => 'Silindi'],200);
		}else {
			return response()->json(['message' => 'Silinecek Öge Bulunamadı'],404);
		}
	}

}
