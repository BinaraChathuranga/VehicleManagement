<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class adminMiddleware
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
        if(!Auth::check()){
            return redirect()->route('login');
        }

        //role 1 = admin
        if(Auth::user()->role == 'Admin'){
            return $next($request);
        }

        //role 2 = inactive
        if(Auth::user()->role == 'Inactive user'){
            return redirect()->route('inactive');
        }

        //role 3 = director
        if(Auth::user()->role == 'Director'){
            return redirect()->route('director');
        }

         //role 4 = zonalAdmin
         if(Auth::user()->role == 'Zonal Admin'){
            return redirect()->route('zonalAdmin');
        }

         //role 5 = user
         if(Auth::user()->role == 'User'){
            return redirect()->route('user');
        }

         //role 6 = manager
         if(Auth::user()->role == 'Manager'){
            return redirect()->route('manager');
        }
    }
}
