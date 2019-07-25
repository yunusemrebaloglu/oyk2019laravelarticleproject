<?php

namespace App\Http\Middleware;

use Closure;

class FeyzAl
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
		$feyzAl = [
			"Ben Senin İçin Ubuntuyu  Değil Windowsu Göze aldım",
			"Ben yazlımın hızlı, işlevsel ve Özgür olanını severim."
		];

		$request->feyzal = collect($feyzAl)->random();
        return $next($request);
    }
}
