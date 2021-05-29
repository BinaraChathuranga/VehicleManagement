<?php

namespace App\Http\Controllers\manager;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\reservation;
use Auth;
use App\driverDetail;
use App\vehicleDetail;

class managerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $viewUserRes=DB::table('reservation')
          
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','users.name','users.branch','users.position') 
        ->where('resStatus','=','Not Approved')
        ->where('reservation.zone','=',Auth::user()->zone) 
        ->get();
       
        return view('manager.ViewUserReservations')->with('view',$viewUserRes);
        
    }

    public function approveReservation(Request $request,$id)
    {
       
       $confirmRes=reservation::where('id','=',$id)->where('resStatus','=','Not Approved')->first();
       $confirmRes->resStatus='Approved';
       $confirmRes->vehicleNo='Not Assigned';
       $confirmRes->vType='Not Assigned';
       $confirmRes->driver='Not Assigned';
       $confirmRes->save();

        return redirect()->back()->with('status',"Reservation was Approved Successfully !");
    }

    public function cancelReservation($id)
    {
       
       $confirmRes=reservation::where('id','=',$id)->where('resStatus','=','Not Approved')->first();
       $confirmRes->resStatus='Cancelled';
       $confirmRes->save();

        return redirect()->back()->with('status',"Reservation was Cancelled Successfully !");
    }

    public function cancelledReservations()
    {
        $viewUserRes=DB::table('reservation')
          
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','users.name','users.branch','users.position') 
        ->where('resStatus','=','Cancelled')
        ->where('reservation.zone','=',Auth::user()->zone) 
        ->get();
       
        return view('manager.ViewUserCancelledReservations')->with('view',$viewUserRes);
        
    }

    public function approvedReservations()
    {
        $viewUserRes=DB::table('reservation')
          
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','users.name','users.branch','users.position') 
        ->where('resStatus','=','Approved')
        ->where('reservation.zone','=',Auth::user()->zone) 
        ->get();
       
        return view('manager.ViewUserApprovedReservations')->with('view',$viewUserRes);
        
    }
}
