<?php

namespace App\Http\Middleware;

use App\Data\Helper\Assistant;
use Closure;

class SetLocale
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
        Assistant::setLocale();
        return $next($request);
    }
}
