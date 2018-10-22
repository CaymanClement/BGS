<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsApprover
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
         if ( Auth::user()->title == 'HFA' || Auth::user()->title == 'PFA' || Auth::user()->title == 'DGM' || Auth::user()->title == 'GM' ) {

            return $next($request);
     }
 
        return redirect('/page-not-found');
    }
}
