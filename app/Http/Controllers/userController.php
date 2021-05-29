<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Http\Request;
use App\User;
use App\vehicleDetail;
use App\reservation;
use App\driverDetail;

use Auth;


class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.reserveVehicle');
    }

    public function getMprice()
    {
          $k_id=Input::get('k_id');
          $mprice=vehicleDetail::where('id','=',$k_id)->get();
           return response()->json($mprice);
     
     }

     public function reserve(Request $request)
    {
        $reserve=new reservation;
    
        $data=$request->all();
        if(count($request->email) > 0)
        {
            foreach($request->email as $item=>$v)
            {
                $data2=array(

                    'vehicleNo'=>'Not Approved',
                    'vType'=>'Not Approved',
                    'driver'=>'Not Approved',
                    'email'=>$request->email[$item],
                    'zone'=>$request->zone[$item],
                    
                    'ResFrom'=>$request->from[$item],
                    'ResTo'=>$request->to[$item],
                    'reserveDate'=>$request->resDate[$item],
                    'passengers'=>$request->passengers[$item],
                    'endDate'=>$request->endDate[$item],
                    'reason'=>$request->reason[$item],
                    'resStatus'=>'Not Approved',

                );
                
                reservation::insert($data2);
            }
        }
           return redirect()->route('myReservations')->with('status',"Reservation Submitted Succesfully!");
     
     }

     public function myReservations()
     {   
        $myRes=reservation::where('email','=',Auth::user()->email)->get();
         return view('user.myReservations')->with('myRes',$myRes);
        
     }

     public function filterAllResDetails(Request $request)
     {

            $zone=$request->input('zone');
            $status=$request->input('status');
            $from=$request->input('from');
            $to=$request->input('to');
            if($zone != null && $status != null && $from != null && $to != null)
            {
            $filRes=reservation::where('email','=',Auth::user()->email)
            ->where('zone','=',$zone)
            ->where('resStatus','=',$status)
            ->where('reserveDate','>=',$from)
            ->where('reserveDate','<=',$to)
            ->get();
            }
   
            elseif($zone != null && $status == null && $from == null && $to == null)
            {
            $filRes=reservation::where('email','=',Auth::user()->email)
            ->where('zone','=',$zone)
            ->get();
            }
   
            elseif($zone == null && $status != null && $from == null && $to == null)
            {
            $filRes=reservation::where('email','=',Auth::user()->email)
            ->where('resStatus','=',$status)
            ->get();
            }
   
            elseif($zone == null && $status == null && $from != null && $to == null)
            {
            $filRes=reservation::where('email','=',Auth::user()->email)
            ->where('reserveDate','>=',$from)
            ->get();
            }
   
            elseif($zone == null && $status == null && $from == null && $to != null)
            {
               $filRes=reservation::where('email','=',Auth::user()->email)
               ->where('reserveDate','<=',$to)
               ->get();
               }
   
               elseif($zone != null && $status != null && $from == null && $to == null)
               {
                  $filRes=reservation::where('email','=',Auth::user()->email) 
                  ->where('zone','=',$zone)
                  ->where('resStatus','=',$status)
                  ->get();
                  }
   
                  elseif($zone != null && $status == null && $from != null && $to == null)
               {
                  $filRes=reservation::where('email','=',Auth::user()->email)
                  ->where('zone','=',$zone)
                  ->where('reserveDate','>=',$from)
                  ->get();
                  }
   
                  elseif($zone != null && $status == null && $from == null && $to != null)
                  {
                     $filRes=reservation::where('email','=',Auth::user()->email)
                     ->where('zone','=',$zone)
                     ->where('reserveDate','<=',$to)
                     ->get();
                     }
   
                     elseif($zone == null && $status != null && $from != null && $to == null)
                     {
                        $filRes=reservation::where('email','=',Auth::user()->email)
                        ->where('resStatus','=',$status)
                        ->where('reserveDate','>=',$from)
                        ->get();
                        }
   
                        elseif($zone == null && $status != null && $from == null && $to != null)
                     {
                        $filRes=reservation::where('email','=',Auth::user()->email)
                        ->where('resStatus','=',$status)
                        ->where('reserveDate','<=',$to)
                        ->get();
                        }
   
                        elseif($zone == null && $status == null && $from != null && $to != null)
                        {
                           $filRes=reservation::where('email','=',Auth::user()->email)
                           ->where('reserveDate','>=',$from)
                           ->where('reserveDate','<=',$to)
                           ->get();
                           }
   
                           elseif($zone != null && $status != null && $from != null && $to == null)
                        {
                           $filRes=reservation::where('email','=',Auth::user()->email)
                           ->where('reserveDate','>=',$from)
                           ->where('zone','=',$zone)
                           ->where('resStatus','=',$status)
                           ->get();
                           }
   
                           elseif($zone != null && $status != null && $from == null && $to != null)
                        {
                           $filRes=reservation::where('email','=',Auth::user()->email)
                           ->where('reserveDate','<=',$to)
                           ->where('zone','=',$zone)
                           ->where('resStatus','=',$status)
                           ->get();
                           }
   
                           elseif($zone != null && $status == null && $from != null && $to != null)
                           {
                              $filRes=reservation::where('email','=',Auth::user()->email)
                              ->where('reserveDate','<=',$to)
                              ->where('zone','=',$zone)
                              ->where('reserveDate','>=',$from)
                              ->get();
                              }
   
                              
                           elseif($zone == null && $status != null && $from != null && $to != null)
                           {
                              $filRes=reservation::where('email','=',Auth::user()->email)
                              ->where('reserveDate','<=',$to)
                              ->where('resStatus','=',$status)
                              ->where('reserveDate','>=',$from)
                              ->get();
                              } 
        return view('user.filteredmyReservations')->with('myRes',$filRes);
      }



     public function cancelMyReservations($id)
     {    
      
      $cancelReservations=reservation::where('id','=',$id)->first(); 
      $cancelReservations->resStatus='Cancelled';
      $cancelReservations->save();
      return redirect()->back()->with('status1',"Reservation was Cancelled");
        
     }

     public function pendingReservations()
     {    
         $penRes=DB::table('reservation') 
         ->join('users','users.email','=','reservation.email')
         ->select('reservation.*','users.name','users.branch') 
         ->where('reservation.zone','=',Auth::user()->zone)
         ->where('reservation.email','=',Auth::user()->email)
         ->where('reservation.resStatus','=','Not Approved')
         ->get();
       
        
         return view('user.pendingReservations')->with('penRes',$penRes);
        
     }

     public function viewPendingReservations($id)
     {    
         $penRes=DB::table('reservation')
         ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
         ->join('users','users.email','=','reservation.email')
         ->select('reservation.*','vehicleInfo.*','users.*') 
         ->where('reservation.id','=',$id) 
         ->first();
       
        
         return view('user.viewPendingReservation')->with('penRes',$penRes);
        
     }

     public function newResCalender($regNo)
    {    
       $reservations = reservation::where('vehicleNo','=',$regNo
       )->get();
       $reservation =[];
        foreach($reservations as $row)
        {
            if($row->resStatus == 'Confirmed'){
                $reservation[] = \Calendar::event(
          
                    $row->resStatus,
                    true,
                    new \DateTime($row->reserveDate),
                    new \DateTime($row->created_at),
                    $row->id,
                    [ 
                      'color' => '#1931ff',
                    ]             
                 ); 
                }

                elseif($row->resStatus == 'Completed'){
                    $reservation[] = \Calendar::event(
              
                        $row->resStatus,
                        true,
                        new \DateTime($row->reserveDate),
                        new \DateTime($row->created_at),
                        $row->id,
                        [ 
                        'color' => '#298000',
                        ]             
                     ); 
                    }
            
            }
              
            $calendar=\Calendar::addEvents($reservation);
            return view('user.resCalender',compact('reservations','calendar'));


}

public function dynamic()
{
    return view('user.dynamic');
}

}
