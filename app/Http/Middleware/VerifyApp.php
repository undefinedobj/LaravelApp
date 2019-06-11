<?php

namespace App\Http\Middleware;

use Closure;

class VerifyApp
{
    public function handle($request, Closure $next)
    {
        // if ("判断条件") {
            return $next($request);
        // }
    }
}
