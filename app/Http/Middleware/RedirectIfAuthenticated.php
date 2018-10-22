<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
         //   return redirect('/home');

 if(Auth::user()->title == 'System Admin' && Auth::user()->status == 'Active'){
            return redirect('/admin');   
            }

            elseif( Auth::user()->title == 'PFA' && Auth::user()->status == 'Active' ){
            return redirect('/approver'); 
            }

            elseif(Auth::user()->title == 'HFA' && Auth::user()->status == 'Active'){
            return redirect('/approver'); 
            }

            elseif(Auth::user()->title == 'GM' && Auth::user()->status == 'Active'){
            return redirect('/approver'); 
             }

            elseif( Auth::user()->title == 'DGM' && Auth::user()->status == 'Active'){
            return redirect('/approver'); 
            }
            elseif(Auth::user()->status == 'created'){
            return redirect('/change-password')->with('warning','You are Required to Change Password First'); 
            }
            elseif( Auth::user()->title == 'Staff' && Auth::user()->status == 'Active'){
            return redirect('/home'); 
            }            
            else{
                    Auth::logout();
                    return redirect('/error');
                }
            
        }

        return $next($request);
    }
}
