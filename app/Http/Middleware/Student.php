<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function abort;

class Student
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
        if($request->user()->role === "student")
        {
            return $next($request);
        }
        abort(403);
    }
}
