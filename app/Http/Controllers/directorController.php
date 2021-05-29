<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\reservation;
use App\driverDetail;
use App\vehicleDetail;
use App\fuelConsumption;
use App\vehiclePart;
use App\repairDetail;
use App\serviceDetail;
use Carbon\Carbon;


class directorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }

    public function dirEditProfile(Request $request,$id)
    { 
        $userIn=User::where('id','=',$id)->first();
        if($request->hasfile('Eavatar')){
        $file=$request->file('Eavatar');
                $extension=$file->getClientOriginalExtension();
                $filename=time() . '.' . $extension;
                $file->move('img/',$filename);
                $userIn->avatar=$filename;
        }   
                $userIn->save();
                return redirect()->back();
     
     }

     public function vehicleDetails(){
        $dvInfo=vehicleDetail::all();
        return view('director.vehicleDetails')->with('dvInfo',$dvInfo);
     }

     public function viewVehicleDetails($regNo){
        $dvInfo=vehicleDetail::where('regNo','=',$regNo)->first();
        return view('director.viewVehicleDetails')->with('dvInfo',$dvInfo);
     }

     public function driverDetails(){
        $dInfo=driverDetail::all();
        return view('director.driverDetails')->with('dInfo',$dInfo);
     }

     public function viewDriverDetails($NIC){
        $dInfo=driverDetail::where('NIC','=',$NIC)->first();
        return view('director.viewDriverDetails')->with('dInfo',$dInfo);
     }

     public function reports(){
       
        return view('director.reports');
     }

     public function reserveVehicle()
     {
         return view('director.reserveVehicle');
     }

     public function newReservation($regNo)
    {    
        $vInfo=vehicleDetail::where('regNo','=',$regNo)->first();
        return view('director.newReservation')->with('dvInfo',$vInfo);
       
    }

     public function regUsers()
     {
         return view('director.registeredUsers');
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
                     'resStatus'=>'Approved',
 
                 );
                 
                 reservation::insert($data2);
             }
         }
            return redirect()->route('directormyReservations')->with('status',"Reservation Submitted Succesfully!");
      
      }

      public function myReservations()
     {    
        $myRes=reservation::where('email','=',Auth::user()->email)->get();
         return view('director.myReservations')->with('myRes',$myRes);
        
     }

     public function reservationDetails()
     {    
         $view=DB::table('reservation')
        ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','vehicleInfo.*','users.*') 
        ->get();
        $viewReservations=DB::table('reservation')
        ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
        ->select('reservation.*','vehicleInfo.*') 
        ->first();
         return view('director.reservationDetails',compact('view','viewReservations'));
        
     }

     public function filterResDirDetails(Request $request)
     {
         
         $zonel=$request->input('zone');
         $status=$request->input('status');
         $from=$request->input('from');
         $to=$request->input('to');
        
         
         if($zonel != null && $status != null && $from != null && $to != null)
          {
          
          $view=DB::table('reservation')
          ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
          ->join('users','users.email','=','reservation.email')
          ->select('reservation.*','vehicleInfo.*','users.*') 
          ->where('reservation.zone','=',$zonel)
          ->where('reservation.resStatus','=',$status)
          ->where('reservation.reserveDate','>=',$from)
          ->where('reservation.reserveDate','<=',$to)
          ->get();
          $heading=$status.' '.'Reservations'.' '.'|'.' '.'zone :'.' '.$zonel.' '.'|'.' '.'From'.' '.$from.' '.'To'.' '.$to;
          }
 
          elseif($zonel != null && $status == null && $from == null && $to == null)
          {
          $view=DB::table('reservation')
          ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
          ->join('users','users.email','=','reservation.email')
          ->select('reservation.*','vehicleInfo.*','users.*') 
          ->where('reservation.zone','=',$zonel)
          ->get();
          $heading='All Reservations'.' '.'|'.''.'zone :'.' '.$zonel;
          }
 
          elseif($zonel == null && $status != null && $from == null && $to == null)
          {
          $view=DB::table('reservation')
          ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
          ->join('users','users.email','=','reservation.email')
          ->select('reservation.*','vehicleInfo.*','users.*') 
          ->where('reservation.resStatus','=',$status)
          ->get();
          $heading='All'.' '.$status.''.'Reservations';
          }
 
          elseif($zonel == null && $status == null && $from != null && $to == null)
          {
          $view=DB::table('reservation')
          ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
          ->join('users','users.email','=','reservation.email')
          ->select('reservation.*','vehicleInfo.*','users.*') 
          ->where('reservation.reserveDate','=',$from)
          ->get();
          $heading='All Reservations'.''.'|'.' '.$from;
          }
 
          elseif($zonel == null && $status == null && $from == null && $to != null)
          {
             $view=DB::table('reservation')
             ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
             ->join('users','users.email','=','reservation.email')
             ->select('reservation.*','vehicleInfo.*','users.*') 
             ->where('reservation.reserveDate','=',$to)
             ->get();
             $heading='All Reservations'.' '.'|'.' '.$to;
             }
 
             elseif($zonel != null && $status != null && $from == null && $to == null)
             {
                $view=DB::table('reservation')
                ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                ->join('users','users.email','=','reservation.email')
                ->select('reservation.*','vehicleInfo.*','users.*') 
                ->where('reservation.zone','=',$zonel)
                ->where('reservation.resStatus','=',$status)
                ->get();

                $heading=$status.' '.'Reservations'.' '.'|'.' '.'zone :'.' '.$zonel;
                }
 
                elseif($zonel != null && $status == null && $from != null && $to == null)
             {
                $view=DB::table('reservation')
                ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                ->join('users','users.email','=','reservation.email')
                ->select('reservation.*','vehicleInfo.*','users.*') 
                ->where('reservation.zone','=',$zonel)
                ->where('reservation.reserveDate','=',$from)
                ->get();

                $heading='zone :'.' '.$zonel.' '.'|'.' '.$from;
                }
 
                elseif($zonel != null && $status == null && $from == null && $to != null)
                {
                   $view=DB::table('reservation')
                   ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                   ->join('users','users.email','=','reservation.email')
                   ->select('reservation.*','vehicleInfo.*','users.*') 
                   ->where('reservation.zone','=',$zonel)
                   ->where('reservation.reserveDate','=',$to)
                   ->get();

                   $heading='zone :'.' '.$zonel.' '.'|'.' '.$to;
                   }
 
                   elseif($zonel == null && $status != null && $from != null && $to == null)
                   {
                      $view=DB::table('reservation')
                      ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                      ->join('users','users.email','=','reservation.email')
                      ->select('reservation.*','vehicleInfo.*','users.*') 
                      ->where('reservation.resStatus','=',$status)
                      ->where('reservation.reserveDate','=',$from)
                      ->get();

                      $heading=$status.' '.'Reservations'.' '.'|'.' '.$from;
                      }
 
                      elseif($zonel == null && $status != null && $from == null && $to != null)
                   {
                      $view=DB::table('reservation')
                      ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                      ->join('users','users.email','=','reservation.email')
                      ->select('reservation.*','vehicleInfo.*','users.*') 
                      ->where('reservation.resStatus','=',$status)
                      ->where('reservation.reserveDate','=',$to)
                      ->get();

                      $heading=$status.' '.'Reservations'.' '.'|'.' '.$to;
                      }
 
                      elseif($zonel == null && $status == null && $from != null && $to != null)
                      {
                         $view=DB::table('reservation')
                         ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                         ->join('users','users.email','=','reservation.email')
                         ->select('reservation.*','vehicleInfo.*','users.*') 
                         ->where('reservation.reserveDate','>=',$from)
                         ->where('reservation.reserveDate','<=',$to)
                         ->get();

                         $heading='From'.' '.$from.' '.'To'.' '.$to;
                         }
 
                         elseif($zonel != null && $status != null && $from != null && $to == null)
                      {
                         $view=DB::table('reservation')
                         ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                         ->join('users','users.email','=','reservation.email')
                         ->select('reservation.*','vehicleInfo.*','users.*') 
                         ->where('reservation.reserveDate','=',$from)
                         ->where('reservation.zone','=',$zonel)
                         ->where('reservation.resStatus','=',$status)
                         ->get();

                         $heading=$status.' '.'Reservations'.' '.'|'.' '.'zone :'.' '.$zonel.' '.'|'.' '.''.' '.$from;
                         }
 
                         elseif($zonel != null && $status != null && $from == null && $to != null)
                      {
                         $view=DB::table('reservation')
                         ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                         ->join('users','users.email','=','reservation.email')
                         ->select('reservation.*','vehicleInfo.*','users.*') 
                         ->where('reservation.reserveDate','=',$to)
                         ->where('reservation.zone','=',$zonel)
                         ->where('reservation.resStatus','=',$status)
                         ->get();

                         $heading=$status.' '.'Reservations'.' '.'|'.' '.'zone :'.' '.$zonel.' '.'|'.' '.$to;
                         }
 
                         elseif($zonel != null && $status == null && $from != null && $to != null)
                         {
                            $view=DB::table('reservation')
                            ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                            ->join('users','users.email','=','reservation.email')
                            ->select('reservation.*','vehicleInfo.*','users.*') 
                            ->where('reservation.reserveDate','<=',$to)
                            ->where('reservation.zone','=',$zonel)
                            ->where('reservation.reserveDate','>=',$from)
                            ->get();

                            $heading='zone :'.' '.$zonel.' '.'|'.' '.'From'.' '.$from.' '.'To'.' '.$to;
                            }
 
                            
                         elseif($zonel == null && $status != null && $from != null && $to != null)
                         {
                            $view=DB::table('reservation')
                            ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
                            ->join('users','users.email','=','reservation.email')
                            ->select('reservation.*','vehicleInfo.*','users.*') 
                            ->where('reservation.reserveDate','<=',$to)
                            ->where('reservation.resStatus','=',$status)
                            ->where('reservation.reserveDate','>=',$from)
                            ->get();

                            $heading=$status.' '.'Reservations'.' '.'|'.' '.'From'.' '.$from.' '.'To'.' '.$to;
                            }
        
     
         return view('director.filteredDirReservationDetails',compact('view','heading'));
      
      }

      public function fuelConsumptionVehicles()
      {
          return view('director.fuelvehicleDetails');
      }

      public function vehFuelConsumption($regNo)
      {
          $fConsumption=fuelConsumption::where('vehicleNo','=',$regNo)->where('status','=','Consumption')->first(); 
          return view('director.viewFuelConsumption')->with('fc',$fConsumption);
      }

      public function viewRefillDetails($regNo)
      {
          $refill=fuelConsumption::where('vehicleNo','=',$regNo)->where('status','=','Refilled')->first(); 
          return view('director.viewRefillFuel')->with('rf',$refill);
      }

      public function filterFuelVehicles(Request $request)
     {
         
         $zone=$request->input('zone');
         $type=$request->input('vType');
         
         if($type == 'Bus' || $type == 'Lorry'||$type == 'Van'||$type == 'Cab'||$type == 'Car'||$type == 'Three Wheeler')
         {
         $filVeh=vehicleDetail::where('type','=',$type)
         ->where('zone','=',$zone)
         ->get();
         }

         elseif($type == 'All')
         {
         $filVeh=vehicleDetail::
         where('zone','=',$zone)
         ->get();
         }
        
     
         return view('director.filteredfuelvehicleDetails')->with('vI',$filVeh);
      
      }

      public function filterFuelConsumption(Request $request)
     {
         
         $from=$request->input('from');
         $to=$request->input('to');
         $vNo=$request->input('vName');
        


         $fc=fuelConsumption::where('vehicleNo','=',$vNo)->where('resDate','>=',$from)->where('resDate','<=',$to)->where('status','=','Consumption')->get();
         return view('director.filteredfuelConsumption',compact('fc','vNo','to','from','zonel'));
      
      }

      public function filterFuelRefill(Request $request)
     {
         
         $from=$request->input('from');
         $to=$request->input('to');
         $vNo=$request->input('vName');
         
         
         $rf=fuelConsumption::where('vehicleNo','=',$vNo)->where('refilledDate','>=',$from)->where('refilledDate','<=',$to)->where('status','=','Refilled')->get();
         return view('director.filteredRefillFuel',compact('rf','vNo','from','to'));
      
      }

      public function serviceDetailsVehicles()
      {
          
          return view('director.serviceVehicle');
      }

      public function filterServiceVehicles(Request $request)
     {
         
         $zone=$request->input('zone');
         $type=$request->input('vType');
         
         if($type == 'Bus' || $type == 'Lorry'||$type == 'Van'||$type == 'Cab'||$type == 'Car'||$type == 'Three Wheeler')
         {
         $filVeh=vehicleDetail::where('type','=',$type)
         ->where('zone','=',$zone)
         ->get();
         }

         elseif($type == 'All')
         {
         $filVeh=vehicleDetail::
         where('zone','=',$zone)
         ->get();
         }
        
     
         return view('director.filteredServiceVehicle')->with('vI',$filVeh);
      
      }

      public function viewVehicleParts($regNo)
      {
          $vParts=vehiclePart::where('vNo','=',$regNo)->first();
          return view('director.serviceParts')->with('vParts',$vParts);
      }

      public function viewServiceDetails($regNo)
      {
          
          $serviceDetails=serviceDetail::where('vehicleNoService','=',$regNo)->first(); 
          return view('director.viewServiceDetails')->with('sd',$serviceDetails);
      }

      public function filterServiceDetails(Request $request)
     {
         
         $from=$request->input('from');
         $to=$request->input('to');
         $vNo=$request->input('vName');
         
         $sd=serviceDetail::where('vehicleNoService','=',$vNo)->where('serviceStart','>=',$from)->where('serviceStart','<=',$to)->get();
         return view('director.filteredServiceDetails',compact('sd','vNo','from','to'));
      
      }

      public function runningChartVehicles()
      {
          return view('director.runningChartVehicles');
      }
      

      public function filterRuningChartVehicles(Request $request)
      {
        $zone=$request->input('zone');
        $vType=$request->input('vType');
           
          $filterVehicles=vehicleDetail::where('zone','=',$zone)->where('type','=',$vType)->get();
          return view('director.filteredRunningChartVehicles')->with('vI',$filterVehicles);
      }

      public function runnigChart($regNo)
      {
          $rc=fuelConsumption::where('vehicleNo','=',$regNo)->first(); 
          return view('director.viewRunningChart')->with('rc',$rc);
      }

      public function filterRunningChartDetails(Request $request)
     {
         
         $from=$request->input('from');
         $to=$request->input('to');
         $vNo=$request->input('vName');
         
         $rc=DB::table('reservation')
         ->join('fuelconsuption','fuelconsuption.resId','=','reservation.id')  
         ->select('reservation.*','fuelconsuption.*')
         ->where('reservation.vehicleNo','=',$vNo)
         ->where('reservation.reserveDate','>=',$from)
         ->where('reservation.reserveDate','<=',$to)
         ->get();
         

         return view('director.viewFilteredRunningChart',compact('rc','vNo','from','to'));
      
      }

      public function reportsVehicles()
      {
          return view('director.reportsVehicles');
      }

      public function filterReportsVehicles(Request $request)
      {
        $zone=$request->input('zone');
        $vType=$request->input('vType');
           
          $filterVehicles=vehicleDetail::where('zone','=',$zone)->where('type','=',$vType)->get();
          return view('director.filteredReportsVehicles')->with('vI',$filterVehicles);
      }

      public function viewReportVehicleDetails($regNo){
        $dvInfo=vehicleDetail::where('regNo','=',$regNo)->first();
        return view('director.reportsVehicleDetails')->with('dvInfo',$dvInfo);
     }

     public function filterVehiclesReport(Request $request)
     {
       $zonel=$request->input('zone');
       $vType=$request->input('vType');
          
         $dvInfo=vehicleDetail::where('zone','=',$zonel)->where('type','=',$vType)->get();
         return view('director.filteredVehiclesReport',compact('dvInfo','zonel','vType'));
     }

     public function filterDriverReport(Request $request)
     {
       $zonel=$request->input('zone');
       
          
         $dInfo=driverDetail::where('zone','=',$zonel)->get();
         return view('director.filteredDriverDetails',compact('dInfo','zonel'));
     }

     public function userReservations(Request $request)
     {
        $viewUserRes=DB::table('reservation')
          
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','users.name','users.branch','users.position') 
        ->where('resStatus','=','Not Approved')
        ->where('reservation.zone','=',Auth::user()->zone) 
        ->get();
       
        return view('director.ViewUserReservations')->with('view',$viewUserRes);
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

    
    public function repair()
    {
        return view('director.repair');
    }

    public function filterRepairVehicles(Request $request)
    {
      $zone=$request->input('zone');
      $vType=$request->input('vType');
         
        $filterVehicles=vehicleDetail::where('zone','=',$zone)->where('type','=',$vType)->get();
        return view('director.repairFiltered')->with('vI',$filterVehicles);
    }

    public function viewRepairDetails($regNo)
       {
           
           $repairDetails=repairDetail::where('vehicleNoRepair','=',$regNo)->first(); 
           return view('director.viewRepairDetails')->with('rd',$repairDetails);
       }

       public function filterRepairDetails(Request $request)
       {
           
           $from=$request->input('from');
           $to=$request->input('to');
           $vNo=$request->input('vName');
           $type=$request->input('repairType');
           
           $rd=repairDetail::where('vehicleNoRepair','=',$vNo)->where('repairType','=',$type)->where('repairStarted','>=',$from)->where('repairStarted','<=',$to)->get();
           return view('director.viewFilteredRepairDetails',compact('rd','vNo','from','to','type'));
        
        }
}