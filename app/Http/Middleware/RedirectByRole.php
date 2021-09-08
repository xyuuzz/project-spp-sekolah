<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectByRole
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
        $status_url = explode("/", $request->getUri())[3];

        if($request->user()->role === "admin" && $status_url === "admin")
        {
            return $next($request);
        }
        else if($request->user()->role === "student" && $status_url === "s")
        {
            return $next($request);
        }

        abort(403);
    }
}
