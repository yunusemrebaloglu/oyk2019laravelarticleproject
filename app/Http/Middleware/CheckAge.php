<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$age = $request->user()->age;
		// dd($age);
		if ($age < 18) return abort(403);
        return $next($request);
    }
}
