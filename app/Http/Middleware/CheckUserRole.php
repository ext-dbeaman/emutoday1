<?php

namespace emutoday\Http\Middleware;

use Closure;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $urole = null)
    {
            //if user loged in  AND
            //if user has role of admin
            //
            $user = $request->user();

            if ($user && $user->hasRole($urole) ) {
                return $next($request);
            }

            return redirect('/');


    }
}
