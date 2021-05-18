<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhotoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->header('CLE-UNIQUE')) {
            return response()->json(['erreur' => 'Action impossible']);
        }
        return $next($request);
    }
}
