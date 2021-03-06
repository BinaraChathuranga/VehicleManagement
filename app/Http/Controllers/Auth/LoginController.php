<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo ='/inactive';

    public function redirectTo(){
        switch (Auth::user()->role) {
            case 1:
                $this->redirectTo = '/inactive';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = '/admin';
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = '/director';
                return $this->redirectTo;
                break;
            case 4:
                $this->redirectTo = '/zonalAdmin';
                return $this->redirectTo;
                break;
            case 5:
                $this->redirectTo = '/user';
                return $this->redirectTo;
                break;
            case 6:
                $this->redirectTo = '/manager';
                return $this->redirectTo;
                break;        
                
            default:
                $this->redirectTo = '/inactive';
                return $this->redirectTo;
                break;
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
