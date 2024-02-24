<?php

namespace App\Http\Middleware;

use App\Data\Helper\Assistant;
use Closure;

class SetLocationByIP
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
        Assistant::setCountryCode();

        return $next($request);
    }
}
