<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use App\Tag;
use App\Helpers\Mahmut ;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ArticleComment;
use App\Events\ArticleCommentCreated;


class ArticleController extends Controller
{

	public function create()
	{
		return view('article.create');
	}

	public function index(Mahmut $mahmut,Article $article)
	{
		// dd($mahmut);
		// return $mahmut->konus();
		$articles = $article->latest()->paginate(4);
		return view('article.index',compact('articles'));
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
		$article = new Article;
		$article->user_id = $request->user()->id;
		$article->title = $request->input("title");
		$article->content = $request->input("content");

		if($request->file('photo'))
		{
			$path = $request->file('photo')->store('public/app/articlePhoto');
			$article->image_address = $path;
		}

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


		return redirect(route('article.detail', $article));
	}

	public function detail(Article $article)
	{
		// dd(asset(Storage::url($article->image_address)));
		return view('article.detail',compact('article'));
	}

	public function edit(Article $article, Request $request)
	{
		if ($article->user->id !== $request->user()->id) return redirect(route('index'));
		return view('article.edit',compact('article'));
	}

	public function update(Request $request, Article $article)
	{
		if ($article->user->id !== $request->user()->id) return redirect(route('article.index'));
		$request->validate([
			'title' 	=> 'string|required',
			'content' 	=> 'string|required',
			'tags' 		=> 'string|nullable',
			'photo' 	=> 'image|nullable'
		]);
		if($request->file('photo'))
		{
			$path = $request->file('photo')->store('public/app/articlePhoto');
			$article->image_address = $path;
		}
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
					// $article->tags()->attach($t);
				}
			}
		}
		$article->tags()->sync($newtag);

		return redirect(route('article.detail', $article));
	}

	public function destroy(Article $article)
	{
		if ($article->user->id !== $request->user()->id) return redirect(route('index'));
		$article->forceDelete();
		return redirect(route('index'));
	}

	public function addComment(Article $article,Request $request)
	{

		$request->validate([
			'body' => 'string|required|min:3',
			'parent_id' =>'string|nullable'
		]);
		// $article->addComment($article,$request->user()->id,$request->body,$request->parent_id);
		$comment = new Comment;
		if($request->parent_id)
		{
			$comment->parent_id = $request->parent_id;
		}

		$comment->article_id = $article->id;
		$comment->user_id = $request->user()->id;
		$comment->body = $request->body;
		$comment->save();
		event(new ArticleCommentCreated($article, $comment));
		// dd($article->user->id);
		return redirect(route('article.detail', $article));
	}
	public function tagInArticles(Tag $tag)
	{
		$articles = $tag->articles()->latest()->paginate(2);
		return view('article.index',compact('articles','tag'));

	}

	public function articleIntags()
	{
		// $tags = Tag::all();
		$tags = Tag::latest()->paginate(5);
		return view('article.articleIntags', compact('tags'));

	}

}
