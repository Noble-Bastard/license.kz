<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckUTM
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
        //utm_medium=site&utm_source=sbrkn_google&utm_campaign=licenzirovanie_kz_poisk&utm_term={keyword}
        if($request->has('utm_source')){
            $utm = new \stdClass();
            $utm->utm_source = $request->get('utm_source');
            $utm->utm_medium = $request->get('utm_medium');
            $utm->utm_campaign = $request->get('utm_campaign');
            $utm->utm_term = $request->get('utm_term');
            $utm->utm_content = $request->get('utm_content');

            Session::put('utm', json_encode($utm));
        }
        return $next($request);
    }
}