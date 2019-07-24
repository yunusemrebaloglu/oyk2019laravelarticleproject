<?php

namespace App\Http\Middleware;

use Closure;

class ArticleAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $article)
    {
		// dd($article);
		if ($article != $request->user()->id) {
			return redirect(route('index'));
		}
		return $next($request);
    }
}
