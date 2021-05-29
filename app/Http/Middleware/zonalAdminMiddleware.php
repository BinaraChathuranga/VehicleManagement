<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class zonalAdminMiddleware
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

        //role 1 = zonalAdmin
        if(Auth::user()->role == 'Zonal Admin'){
            return $next($request);
        }

        //role 2 = admin
        if(Auth::user()->role == 'Admin'){
            return redirect()->route('admin');
        }

         //role 3 = director
         if(Auth::user()->role == 'Director'){
            return redirect()->route('director');
        }

        //role 4 = inactive
        if(Auth::user()->role == 'Inactive user'){
            return redirect()->route('inactive');
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
