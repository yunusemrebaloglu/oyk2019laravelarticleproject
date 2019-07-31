<?php

namespace App\Listeners;

use App\Events\ArticleCommentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Notifications\ArticleComment;

class SendCommentNotificationToAricle implements ShouldQueue
{
	/**
	* Create the event listener.
	*
	* @return void
	*/
	public function __construct()
	{
		//
	}

	/**
	* Handle the event.
	*
	* @param  ArticleCommentCreated  $event
	* @return void
	*/
	public function handle(ArticleCommentCreated $event)
	{
		// dd($event->comment);
		// dd($event->article);
		// // TODO: hata var
		// sleep(10);
		if (isset($event->comment->parent_id)) {
			$event->comment->parent->user->notify(
				new ArticleComment($event->comment->user , $event->article ,$event->comment)
			);

		}else {

			$event->article->user->notify(
				new ArticleComment($event->comment->user , $event->article ,$event->comment)
			);
		}
	}
}
