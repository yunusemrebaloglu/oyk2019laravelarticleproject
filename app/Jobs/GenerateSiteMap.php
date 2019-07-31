<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App;
use App\User;
use App\Article;
use Carbon\Carbon;


class GenerateSiteMap implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	* Create a new job instance.
	*
	* @return void
	*/
	public function __construct()
	{
		//
	}

	/**
	* Execute the job.
	*
	* @return void
	*/
	public function handle()
	{
		$sitemap = App::make("sitemap");

		$sitemap->add(route('article.index'), Carbon::now(), '1.0', 'daily');

				$articles = Article::orderBy('created_at','desc')->get();

				foreach ($articles as $article)
				{
					$sitemap->add(route('article.detail',$article),$article->updated_at,'0.9','weekly');
				}

				$users= Users::all();
				foreach ($users as $user)
				{
					$sitemap->add(route('user.detail',$user),$user->updated_at,'0.9','weekly');
				}

			$sitemap->store('xml', 'mysitemap');


	}
}
