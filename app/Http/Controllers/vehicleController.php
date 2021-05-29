<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vehicleDetail;
use App\vehiclePart;
use App\fuelConsumption;

class vehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vInfo=vehicleDetail::all();
        return view('admin.vehicleDetails')->with('dvInfo',$vInfo);
    }

    public function viewVehicleDetails($regNo)
    {
       
        $vInfo=vehicleDetail::where('regNo','=',$regNo)->first();
        return view('admin.viewVehicleDetails')->with('dvInfo',$vInfo);

    
    }
    public function editVDetails($regNo)
    {
       
       $vInfo=vehicleDetail::where('regNo','=',$regNo)->first();
        return view('admin.editVehicleDetails')->with('vInfo',$vInfo);

    
    }

    public function deleteVDetails($regNo)
    {
       
        $vInfo=vehicleDetail::where('regNo','=',$regNo)->first();
       $vInfo->status='Not Available';
       $vInfo->delete();
       return redirect()->route('zonalAdmin.vehicleDetails.index')->with('status',"Deleted Succesfully!");

    
    }

    public function editVehicleDetails(Request $request, $regNo)
    {
            $vehicleInfo=vehicleDetail::where('regNo','=',$regNo)->first();
            $vehicleInfo->zone=$request->input('zone');
            $vehicleInfo->regNo=$request->input('regNo');
            $vehicleInfo->regDate=$request->input('regDate');
            $vehicleInfo->makeAndtype=$request->input('m&t'); 
            $vehicleInfo->chasisNo=$request->input('chaNo'); 
            $vehicleInfo->engineNo=$request->input('engNo'); 
            $vehicleInfo->horsePower=$request->input('horsePower'); 
            $vehicleInfo->typeOfBody=$request->input('tOfBody');
            $vehicleInfo->payLoad=$request->input('payLoad'); 
            $vehicleInfo->fTyreSize=$request->input('tyreFront');
            $vehicleInfo->rTyreSize=$request->input('tyreRear');
            $vehicleInfo->batteryVoltage=$request->input('batteryVolt');  
            $vehicleInfo->batteryAmp=$request->input('batteryAmp');  
            $vehicleInfo->capacity=$request->input('capacity');  
            $vehicleInfo->crankSize=$request->input('crank'); 
            $vehicleInfo->type=$request->input('type'); 
            $vehicleInfo->passengers=$request->input('passengers'); 
            $vehicleInfo->vehDriver=$request->input('driver'); 
            $vehicleInfo->serviceMileage=$request->input('serviceMilage'); 
            
            if($request->hasfile('image')){
                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $filename=time() . '.' . $extension;
                $file->move('img/',$filename);
                $vehicleInfo->image=$filename;
            }

        $vehicleInfo->save();
        return redirect()->route('admin.vehicleDetails.index')->with('status',"Edited Succesfully!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.insertVehicleDetails');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicleInfo=new vehicleDetail;
        $vehicleInfo->zone=$request->input('zone');
        $vehicleInfo->regNo=$request->input('regNo');
        $vehicleInfo->regDate=$request->input('regDate');
        $vehicleInfo->makeAndtype=$request->input('m&t'); 
        $vehicleInfo->chasisNo=$request->input('chaNo'); 
        $vehicleInfo->engineNo=$request->input('engNo'); 
        $vehicleInfo->horsePower=$request->input('horsePower'); 
        $vehicleInfo->typeOfBody=$request->input('tOfBody');
        $vehicleInfo->payLoad=$request->input('payLoad'); 
        $vehicleInfo->fTyreSize=$request->input('tyreFront');
        $vehicleInfo->rTyreSize=$request->input('tyreRear');
        $vehicleInfo->batteryVoltage=$request->input('batteryVolt');  
        $vehicleInfo->batteryAmp=$request->input('batteryAmp');  
        $vehicleInfo->capacity=$request->input('capacity');  
        $vehicleInfo->crankSize=$request->input('crank'); 
        $vehicleInfo->type=$request->input('type'); 
        $vehicleInfo->passengers=$request->input('passengers');   
        $vehicleInfo->vehDriver=$request->input('driver'); 
        $vehicleInfo->serviceMileage=$request->input('serviceMilage'); 

        $serviceMileage=$request->input('serviceMilage'); 
        $remindMileage=$serviceMileage-1000;
        
        $service=new vehiclePart;
        $service->vNo=$request->input('regNo');
        $service->zone=$request->input('zone');
        $service->partName="Full Service";
        $service->serviceMileage=$request->input('serviceMilage');
        $service->remindMileage=$remindMileage;
        $service->temp=$remindMileage;

    if($request->hasfile('image')){
        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
        $filename=time() . '.' . $extension;
        $file->move('img/',$filename);
        $vehicleInfo->image=$filename;
    }

    $vehicleInfo->save() && $service->save();
    return redirect()->route('admin.vehicleDetails.index')->with('status',"Inserted Succesfully!");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
