<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Comment;
class Article extends Model
{
	//
	public function addComment($article,$userid,$comentBody,$parent_id = null){

		// dd($article);
		// $comment = new Comment;
		if($parent_id) $comment->parent_id = $request->parent_id;
		$comment->article_id = $article->id;
		$comment->user_id = $userid;
		$comment->body = $comentBody;
		$comment->save();
		return true;
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function topLevelComments()
	{
		return $this->comments()->where('parent_id', NULL);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}
}
