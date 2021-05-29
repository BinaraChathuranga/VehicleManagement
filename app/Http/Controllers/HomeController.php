<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\district;
use App\zone;

use App\branch;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('home');
    }
    

    public function complete()
    { 
        return view('complete ');
    }

    public function getzone()
    {
          $d_id=Input::get('d_id');
          $mprice=zone::where('district','=',$d_id)->get();
           return response()->json($mprice);
     
    }

     public function getbranch()
     {
           $div_id=Input::get('z_id');
           $branch=branch::where('zone','=',$div_id)->get();
            return response()->json($branch);
      
      }

      public function completeUser(Request $request,$id)
     {
       
       

        $data=User::find($id);

        $data->district=$request->input('district');
        $data->zone=$request->input('zone');
        $data->branch=$request->input('branch');
        $data->position=$request->input('position');
        $data->preRole=$request->input('preRole');

        $data->save();
        return redirect()->route('inactive')->with('status','You are successfully registered into system, Please wait for admin approval !');
      
      }
   
}
