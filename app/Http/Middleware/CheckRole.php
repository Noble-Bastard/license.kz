<?php

namespace App\Http\Middleware;

use App\Data\Core\Dal\RoleDal;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        foreach (explode('|', $role) as $r) {
            $roleEntity = RoleDal::getByName($r);

            if (Auth::user()->isUserInRole($roleEntity->id)) {
                return $next($request);
            }
        }


        return redirect(404);
    }
}
