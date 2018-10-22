<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAuditor
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
         if ( Auth::user()->title == 'Auditor') {

            return $next($request);
     }
 
        return redirect('/page-not-found');
    }
}
