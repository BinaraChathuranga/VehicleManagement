<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mavinoo\Batch\Batch;
use App\User;
use App\reservation;
use Auth;
use App\driverDetail;
use App\vehicleDetail;
use App\fuelConsumption;
use App\vehiclePart;
use App\repairDetail;
use App\serviceDetail;
use Carbon\Carbon;

class adminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test()
    {
        $vehicle=vehicleDetail::all();
        return view('admin.testNew')->with('vehicle',$vehicle);
    }
    
    public function index()
    {
        return view('admin.registeredUsers');
    }
    public function editRegUser($id)
    {
        $editUser=User::find($id);
        return view('admin.editRegUser')->with('edit',$editUser);
    }

    public function viewRegUser($id)
    {
        $viewUser=User::find($id);
        return view('admin.ViewRegUser')->with('view',$viewUser);
    }

    public function viewUserReservations()
    {
        $current = Carbon::now();
        // add 7 days to the current time
        $week = $current->addDays(7);

        $viewUserRes=DB::table('reservation') 
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','users.name','users.branch','users.position') 
        ->where('reservation.reserveDate','<=',$week)
        ->where('resStatus','=','Approved')
        ->where('reservation.zone','=',Auth::user()->zone) 
        
        ->get();
       
        return view('admin.ViewUserReservations')->with('view',$viewUserRes);
    }

    public function viewPendingReservations()
    {
        $viewUserRes=DB::table('reservation')
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','users.name','users.branch','users.position') 
        ->where('resStatus','=','Pending')
        ->where('reservation.zone','=',Auth::user()->zone) 
        ->get();
       
        return view('admin.ViewUserPendingReservations')->with('view',$viewUserRes);
    }

    public function viewConfirmedReservations()
      {
          $viewUserRes=DB::table('reservation')
          ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
          ->join('users','users.email','=','reservation.email')
          ->select('reservation.*','vehicleInfo.status','vehicleInfo.type','vehicleInfo.regNo','users.name','users.branch','users.position') 
          ->where('resStatus','=','Confirmed')
          ->where('reservation.zone','=',Auth::user()->zone) 
          ->get();
         
          return view('admin.ViewUserConfirmedReservations')->with('view',$viewUserRes);
      }

    public function confirmReservation(Request $request,$id)
      {

        $today1=Carbon::today();
        $today=$today1->format('y/m/d');

        $count2=reservation::where('temp','=',$today)->get();
        $count=$count2->count();
        $count1=$count+1;

        if($count <= 8)
        {
            $tot=$today."-"."00".$count1;
        }

        elseif($count == 9 || $count >= 10 && $count <= 98)
        {
            $tot=$today."-"."0".$count1;
        }

         $confirmRes=reservation::where('id','=',$id)->first();
         $confirmRes->resStatus='Pending';
         $confirmRes->vehicleNo='Pending';
         $confirmRes->vType='Pending';
         $confirmRes->driver='Pending';
         $confirmRes->temp=$today;
         $confirmRes->reservationId=$tot;
         $confirmRes->save();
        return view('admin.reserveVehicle')->with('status',"Reservation was Confirmed Successfully !");
      }

    public function completeReservation(Request $request,$id)
    {
        $completeRes=reservation::where('id','=',$id)->first();
         $completeRes->resStatus='Completed';
         $completeRes->save();
         return redirect()->back()->with('status',"Reservation was Completed Successfully");
    }

    public function editReservation($id)
    {
       $editRes=reservation::where('id','=',$id)->first();
      return view('admin.editReserveVehicle')->with('edit',$editRes);
    }

    public function editReservationInfo(Request $request, $regNo)
    {
       $vehicle=vehicleDetail::where('regNo','=',$regNo)->first();
       $resId=$request->input('ResId');

      return view('admin.editReservation',compact('vehicle','resId'));
    }

    public function newReservation($regNo)
    {    
        $vInfo=vehicleDetail::where('regNo','=',$regNo)->first();
        return view('admin.newReservation')->with('dvInfo',$vInfo);
       
    }
    
    public function reserve(Request $request)
    {

        
        $resNo=$request->input('resId');
        $reserve=reservation::where('id','=',$resNo)->first();
            $reserve->vehicleNo=$request->input('vehicleNo');
            $reserve->driver=$request->input('driver');
            $reserve->vType=$request->input('type');
            $reserve->resStatus='Confirmed';  

            $reserve->save();
    
           return redirect()->route('viewUserReservation')->with('status',"Reservation was Successfull !");
     
     }

     public function editReserve(Request $request,$id)
     {
         
         
         $reserve=reservation::where('id','=',$id)->first();
             $reserve->vehicleNo=$request->input('vehicleNo');
             $reserve->driver=$request->input('driver');
             $reserve->vType=$request->input('type');
             $reserve->ResFrom=$request->input('from');
             $reserve->ResTo=$request->input('to');
             $reserve->reserveDate=$request->input('resDate');
             $reserve->endDate=$request->input('endDate');
             $reserve->passengers=$request->input('ResPassengers');
             $reserve->reason=$request->input('reason');
             
             $reserve->resStatus='Confirmed';  
 
             $reserve->save();
     
            return redirect()->route('viewUserReservation')->with('status',"Reservation was edited Successfully !");
      
      }

      public function cancelReservations($id)
      {    
       
       $cancelReservations=reservation::where('id','=',$id)->first(); 
       $cancelReservations->resStatus='Cancelled';
       $cancelReservations->save();
       return redirect()->back()->with('status1',"Reservation was Cancelled");
         
      }

    public function viewCompletedReservations()
    {
        $view=DB::table('reservation')
        ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','vehicleInfo.status','vehicleInfo.type','vehicleInfo.regNo','vehicleInfo.avaFuel','users.name','users.branch','users.position') 
        ->where('resStatus','=','Completed')
        ->where('reservation.zone','=',Auth::user()->zone) 
        ->get();
       
        return view('admin.ViewUserCompletedReservations')->with('view',$view);
    }

    public function viewCancelledReservations()
    {
        $viewUserRes=DB::table('reservation')
        ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
        ->join('users','users.email','=','reservation.email')
        ->select('reservation.*','vehicleInfo.*','users.*') 
        ->where('resStatus','=','Cancelled')
        ->where('reservation.zone','=',Auth::user()->zone) 
        ->get();
       
        return view('admin.ViewUserCancelledReservations')->with('view',$viewUserRes);
    }



    public function editedRegUser(Request $request,$id)
     {
        $data=User::find($id);

        $data->district=$request->input('district');
        $data->zone=$request->input('zone');
        $data->branch=$request->input('branch');
        $data->position=$request->input('position');
        $data->preRole=$request->input('preRole');
        $data->role=$request->input('Role');

        $data->save();
        return redirect()->route('admin')->with('status',"Updated Succesfully!");
      
      }

      public function reservationDetails()
       {    
           $viewReservations=DB::table('reservation')
          ->join('vehicleInfo','vehicleInfo.regNo','=','vehicleNo')  
          ->join('users','users.email','=','reservation.email')
          ->select('reservation.*','vehicleInfo.*','users.*') 
          ->where('reservation.zone','=',Auth::user()->zone)
          ->get();
           return view('admin.reservationDetails')->with('view',$viewReservations);
          
       }

     public function filterAllResDetails(Request $request)
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
     
         return view('admin.filteredAllReservationDetails',compact('view','heading'));
      
      }

      public function vehicleFilter(Request $request)
     {
         
         $type=$request->input('type');
         if($type == 'Bus' || $type == 'Lorry'||$type == 'Van'||$type == 'Cab'||$type == 'Car'||$type == 'Three Wheeler')
         {
         $filVeh=vehicleDetail::where('type','=',$type)
         ->where('zone','=',Auth::user()->zone)
         ->where('status','=','Available')
         ->get();
         }

         elseif($type == 'All')
         {
         $filVeh=vehicleDetail::
         where('zone','=',Auth::user()->zone)
         ->where('status','=','Available')
         ->get();
         }
         return view('admin.filteredVehicle')->with('resVehicle',$filVeh);
      
      }

      public function changeVehicle($reserveDate)
{ 

    // $vehic=DB::table('vehicleinfo')
    // ->join('reservation','reservation.vehicleNo','=','regNo')  
    // ->select('vehicleinfo.*') 
    // ->whereColumn('reservation.reserveDate','!=',$reserveDate)
    // ->get();
    $details=vehicleDetail::all();
    return view('admin.test')->with('vehDetails',$details);
}

public function runningChartVehicles()
{
    return view('admin.runningChartVehicles');
}

public function filterRuningChartVehicles(Request $request)
      {
        $zone=$request->input('zone');
        $vType=$request->input('vType');
           
          $filterVehicles=vehicleDetail::where('zone','=',$zone)->where('type','=',$vType)->get();
          return view('admin.filteredRunningChartVehicles')->with('vI',$filterVehicles);
      }

      public function runnigChart($regNo)
      {
          $rc=fuelConsumption::where('vehicleNo','=',$regNo)->first(); 
          return view('admin.viewRunningChart')->with('rc',$rc);
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
         

         return view('admin.viewFilteredRunningChart',compact('rc','vNo','from','to'));
      
      }

      public function serviceVehicles()
      {
          return view('admin.serviceVehicle');
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
         
      
          return view('admin.filteredServiceVehicle')->with('vI',$filVeh);
       
       }
       public function vehicleServiceParts($regNo)
      {
        $vehicle=vehicleDetail::where('regNo','=',$regNo)->first();
          return view('admin.vehicleParts')->with('vehicle',$vehicle);
      }

      public function insertVehicleParts(Request $request)
      {
          $vParts=new vehiclePart;
      
          $data=$request->all();
          if(count($request->vNo) > 0)
          {
              foreach($request->vNo as $item=>$v)
              {
                  $data2=array(
  
    
                      'vNo'=>$request->vNo[$item],
                      'zone'=>$request->zone[$item],
                      
                      'partName'=>$request->partName[$item],
                      'serviceMileage'=>$request->serviceMileage[$item],
                      'remindMileage'=>$request->remindMileage[$item],
                      'temp'=>$request->remindMileage[$item],
  
                  );
                  
                  vehiclePart::insert($data2);
              }
          }
             return redirect()->back()->with('status',"Parts Submitted Succesfully!");
       
       }

       public function viewVehicleParts($regNo)
       {
           $vParts=vehiclePart::where('vNo','=',$regNo)->first();
           return view('admin.serviceParts')->with('vParts',$vParts);
       }

       public function addServiceDetails(Request $request)
       {
           $vNo=$request->input('vehNo');
           $partName=$request->input('partName');
           $serviceVehParts=vehiclePart::where('vNo','=',$vNo)->where('partName','=',$partName)->first();
           $serviceVehParts->serviceStatus="At Service";

           $serviceVehicle=vehicleDetail::where('regNo','=',$vNo)->first();
           $serviceVehicle->status="At Service";

           $serviceDetails=new serviceDetail;
           $serviceDetails->vehicleNoService=$request->input('vehNo');
           $serviceDetails->partNameService=$request->input('partName');
           $serviceDetails->serviceStart=$request->input('serviceStart');
           $serviceDetails->serviced_at=$request->input('servicedAt');

           $serviceVehParts->save() && $serviceDetails->save() && $serviceVehicle->save();

           return redirect()->back()->with('status',"Successfully added to service!");
       }

       public function ServicedDetails(Request $request)
       {
           $vNo=$request->input('vehNo');
           $partName=$request->input('partName');
           $serviceVehParts=vehiclePart::where('vNo','=',$vNo)->where('partName','=',$partName)->first();
           $serviceVehParts->serviceStatus="Not at Service";
           $serviceVehParts->currentMileage= 0;

           $serviceVehicle=vehicleDetail::where('regNo','=',$vNo)->first();
           $serviceVehicle->status="Available";
           
           $serviceDetails=serviceDetail::where('vehicleNoService','=',$vNo)->where('partNameService','=',$partName)->first();;
           $serviceDetails->serviceEnd=$request->input('serviceEnd');
           $serviceDetails->serviceDetails=$request->input('serviceDetails');
           $serviceDetails->servicePayment=$request->input('payment');
           $serviceDetails->statusService="Serviced";
           

           $serviceVehParts->save() && $serviceDetails->save() && $serviceVehicle->save();

           return redirect()->back()->with('status',"Successfully Serviced!");
       }

       public function extendMileage(Request $request)
       {
           $vNo=$request->input('vNo');
           $partName=$request->input('partName');
           $extendMileage=$request->input('extendMileage');

           $extend=vehiclePart::where('vNo','=',$vNo)->where('partName','=',$partName)->first();
           $reMileage=$extend->remindMileage + $extendMileage;
           $extend->remindMileage=$reMileage;
           $extend->save();

           return redirect()->back()->with('status',"Remind mileage extended Successfully!");
       }

       public function editPartsDetails(Request $request)
       {
           $pId=$request->input('partId');
           $editParts=vehiclePart::where('id','=',$pId)->first();
           $editParts->partName=$request->input('partName');
           $editParts->serviceMileage=$request->input('serviceMileage');
           $editParts->remindMileage=$request->input('remindMileage');
           
           $editParts->save();

           return redirect()->back()->with('status',"Part Details edited successfully");
       }

       public function viewServiceDetails($regNo)
       {
           
           $serviceDetails=serviceDetail::where('vehicleNoService','=',$regNo)->first(); 
           return view('admin.viewServiceDetails')->with('sd',$serviceDetails);
       }

       public function filterServiceDetails(Request $request)
       {
           
           $from=$request->input('from');
           $to=$request->input('to');
           $vNo=$request->input('vName');
           
           $sd=serviceDetail::where('vehicleNoService','=',$vNo)->where('serviceStart','>=',$from)->where('serviceStart','<=',$to)->get();
           return view('admin.filteredServiceDetails',compact('sd','vNo','from','to'));
        
        }

        public function newUserReservation()
      {
          return view('admin.newreserveVehicle');
      }

      public function newReserve(Request $request)
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
            return redirect()->route('viewUserReservation')->with('status',"Reservation Submitted Succesfully!");
      
      }

      public function resFuelConsumption(Request $request)
      {
          $vehId=$request->input('regNo');
          $resId=$request->input('resId');

          $reservation=reservation::where('id','=',$resId)->first();
          $reservation->journey=$request->input('journey');
          $reservation->OutTime=$request->input('out');
          $reservation->InTime=$request->input('in');
          $reservation->PlacesVisited=$request->input('places');
          $reservation->via=$request->input('via');

          $reservation->resStatus='Successfull';

          $VehicleFuelConsumption=vehicleDetail::where('regNo','=',$vehId)->first();
          $VehicleFuelConsumption->avaFuel=$request->input('fuelBal');
          $VehicleFuelConsumption->milometer=$request->input('end');

          $fuelConsumption=new fuelConsumption;
 
          $fuelConsumption->vehicleNo=$request->input('regNo');
          $fuelConsumption->resId=$request->input('resId');
          $fuelConsumption->fuelHadAvailable=$request->input('Avafuel');
          $fuelConsumption->fuelConsumption=$request->input('fuel');
          $fuelConsumption->totalFuel=$request->input('fuelBal');
          $fuelConsumption->miloMeterStart=$request->input('start');
          $fuelConsumption->miloMeterEnd=$request->input('end');
          $fuelConsumption->journey=$request->input('journey');
          $fuelConsumption->resDate=$request->input('resDate');
          $fuelConsumption->status='Consumption';
         
          $journey=$request->input('journey');

          
          if(count($request->idv) > 0)
          {
              foreach($request->idv as $item=>$v)
              {
                  $data2=array(
                      'currentMileage'=>$journey + $request->cm[$item],
                  );
                  
                  $up=DB::table('vehicleparts')->where('id',$request->idv[$item])->update(['currentMileage' => $journey + $request->cm[$item]]);
              }
          }

          
        
       $VehicleFuelConsumption->save() && $fuelConsumption->save() &&  $reservation->save();
            return redirect()->back();
         
         
      }

      public function fuelConsumptionVehicles()
      {
          return view('admin.fuelvehicleDetails');
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
         
      
          return view('admin.filteredfuelvehicleDetails')->with('vI',$filVeh);
       
       }
       public function vehFuelConsumption($regNo)
       {
           $fConsumption=fuelConsumption::where('vehicleNo','=',$regNo)->where('status','=','Consumption')->first(); 
           return view('admin.viewFuelConsumption')->with('fc',$fConsumption);
       }

       public function filterFuelConsumption(Request $request)
       {
           
           $from=$request->input('from');
           $to=$request->input('to');
           $vNo=$request->input('vName');
          
           $fc=fuelConsumption::where('vehicleNo','=',$vNo)->where('resDate','>=',$from)->where('resDate','<=',$to)->where('status','=','Consumption')->get();
           return view('admin.filteredfuelConsumption',compact('fc','vNo','to','from','zonel'));
        
        }
        public function viewRefillDetails($regNo)
        {
            $refill=fuelConsumption::where('vehicleNo','=',$regNo)->where('status','=','Refilled')->first(); 
            return view('admin.viewRefillFuel')->with('rf',$refill);
        }

        public function filterFuelRefill(Request $request)
        {
            
            $from=$request->input('from');
            $to=$request->input('to');
            $vNo=$request->input('vName');
            
            
            $rf=fuelConsumption::where('vehicleNo','=',$vNo)->where('refilledDate','>=',$from)->where('refilledDate','<=',$to)->where('status','=','Refilled')->get();
            return view('admin.filteredRefillFuel',compact('rf','vNo','from','to'));
         
         }

         public function refillFuel(Request $request)
      {
          $vId=$request->input('regNo');
          $refillVehicle=vehicleDetail::where('regNo','=',$vId)->first();
          $refillVehicle->avaFuel=$request->input('totalFuel');


          $date=Carbon::now();
          $date2=$date->format('Ymd');
          $vNo=$request->input('regNo');
          $temp=$vNo.'/'.$date2;
          $count=fuelConsumption::where('temp','=',$temp)->get();
          $count1=$count->count();
          $count2=$count1+1;
          $billNo=$temp.'/'.$count2;

          $fuelConsumption=new fuelConsumption;
          $fuelConsumption->temp=$temp;
          $fuelConsumption->FuelBillNo=$billNo;
          $fuelConsumption->vehicleNo=$request->input('regNo');
          $fuelConsumption->fuelHadAvailable=$request->input('avaFuel');
          $fuelConsumption->filledFuel=$request->input('refillFuel');
          $fuelConsumption->totalFuel=$request->input('totalFuel');
          $fuelConsumption->productName=$request->input('product');
          $fuelConsumption->priceOfFuel=$request->input('price');
          $fuelConsumption->fillingStation=$request->input('reCenter');
          $fuelConsumption->refilledDate=$request->input('refilledDate');
          $fuelConsumption->status='Refilled';

         
          $refillVehicle->save() && $fuelConsumption->save();
          return redirect()->back();
      }

      public function reportsVehicles()
      {
          return view('admin.reportsVehicles');
      }

      public function filterReportsVehicles(Request $request)
      {
        $zone=$request->input('zone');
        $vType=$request->input('vType');
           
          $filterVehicles=vehicleDetail::where('zone','=',$zone)->where('type','=',$vType)->get();
          return view('admin.filteredReportsVehicles')->with('vI',$filterVehicles);
      }

      public function viewReportVehicleDetails($regNo){
        $dvInfo=vehicleDetail::where('regNo','=',$regNo)->first();
        return view('admin.reportsVehicleDetails')->with('dvInfo',$dvInfo);
     }

     public function filterVehiclesReport(Request $request)
     {
       $zonel=$request->input('zone');
       $vType=$request->input('vType');
          
         $dvInfo=vehicleDetail::where('zone','=',$zonel)->where('type','=',$vType)->get();
         return view('admin.filteredVehiclesReport',compact('dvInfo','zonel','vType'));
     }

     public function vehicleDetailsReport(){
        $dvInfo=vehicleDetail::all();
        return view('admin.vehicleDetailsReport')->with('dvInfo',$dvInfo);
     }

     public function driverDetailsReport(){
        $dInfo=driverDetail::all();
        return view('admin.driverDetailsReport')->with('dInfo',$dInfo);
     }

     public function filterDriverReport(Request $request)
     {
       $zonel=$request->input('zone');
       
          
         $dInfo=driverDetail::where('zone','=',$zonel)->get();
         return view('admin.filteredDriverDetails',compact('dInfo','zonel'));
     }

     public function viewDriverDetailsReport($NIC){
        $dInfo=driverDetail::where('NIC','=',$NIC)->first();
        return view('admin.viewDriverDetailsReport')->with('dInfo',$dInfo);
     }

     public function repair()
     {
         return view('admin.repair');
     }

     public function filterRepairVehicles(Request $request)
      {
        $zone=$request->input('zone');
        $vType=$request->input('vType');
           
          $filterVehicles=vehicleDetail::where('zone','=',$zone)->where('type','=',$vType)->get();
          return view('admin.repairFiltered')->with('vI',$filterVehicles);
      }

      public function viewRepairDetails($regNo)
       {
           
           $repairDetails=repairDetail::where('vehicleNoRepair','=',$regNo)->first(); 
           return view('admin.viewRepairDetails')->with('rd',$repairDetails);
       }

       public function filterRepairDetails(Request $request)
       {
           
           $from=$request->input('from');
           $to=$request->input('to');
           $vNo=$request->input('vName');
           $type=$request->input('repairType');
           
           $rd=repairDetail::where('vehicleNoRepair','=',$vNo)->where('repairStarted','>=',$from)->where('repairType','=',$type)->where('repairStarted','<=',$to)->get();
           return view('admin.viewFilteredRepairDetails',compact('rd','vNo','from','to','type'));
        
        }

        public function completeRepair($regNo)
      {
       $vehicle=repairDetail::where('vehicleNoRepair','=',$regNo)->where('repairStatus','=','At Repair')->first();
       return view('admin.insertVehicleRepair')->with('vehicle',$vehicle);
      }

      public function completedRepair(Request $request)
      {

        $vNo=$request->input('vNo');
        $idR=$request->input('idR');
        $vehicle=vehicleDetail::where('regNo','=',$vNo)->first();
        $vehicle->status="Available";

       $repair=repairDetail::where('id','=',$idR)->first();
        $repair->repairEnded=$request->input('repairEnded');
        $repair->repairDetails=$request->input('repairDetails');
        $serialize=implode(",",$request->partName);
        $repair->partsReplaced=$serialize;
        $repair->repairPayment=$request->input('payment');
        $repair->partsReplaced=$request->input('partName[]');
        $repair->billNo=$request->input('bill');
        $repair->policeReportNo=$request->input('police');
        $repair->insReportNo=$request->input('insuarance');
        $repair->repairStatus="Repaired";

        if(count($request->partName) > 0)
          {
              foreach($request->partName as $item=>$v)
              {   
                  $up=DB::table('vehicleparts')->where('vNo','=',$request->veNo[$item])->where('partName',$request->partName[$item])->update(['currentMileage' => 0]);
              }
      }
      $vehicle->save() && $repair->save();
      return redirect()->route('adminrepair');

}

public function addRepairDetails(Request $request)
{
    $vNo=$request->input('vehNo');
   
    $repairVehicle=vehicleDetail::where('regNo','=',$vNo)->first();
    $repairVehicle->status="At Service";

    $repairDetails=new repairDetail;
    $repairDetails->vehicleNoRepair=$request->input('vehNo');
    $repairDetails->zone=$request->input('zone');
    $repairDetails->repairStarted=$request->input('repairStart');
    $repairDetails->garageName=$request->input('repairAt');
    $repairDetails->milometer=$request->input('milometer');
    $repairDetails->repairType=$request->input('repairType');
    $repairDetails->repairStatus="At Repair";

   $repairDetails->save() && $repairVehicle->save();

    return redirect()->back()->with('status',"Successfully added to Repair!");
}

}
