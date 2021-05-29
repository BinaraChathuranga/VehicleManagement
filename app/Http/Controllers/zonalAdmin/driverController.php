<?php

namespace App\Http\Controllers\zonalAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\driverDetail;
use App\driverWorkplace;
use App\vehiclePart;
use Auth;
use Illuminate\Support\Facades\DB;

class driverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dInfo=driverDetail::where('zone','=',Auth::user()->zone)->get();
        return view('zonalAdmin.driverDetails')->with('dInfo',$dInfo);
    }

    public function viewDriverDetails($NIC)
    {
       
        $dInfo=driverDetail::where('NIC','=',$NIC)->first();
        return view('zonalAdmin.viewDriverDetails')->with('dInfo',$dInfo);

    
    }
    public function editDetails($NIC)
    {
       
       $dInfo=driverDetail::where('NIC','=',$NIC)->first();
        return view('zonalAdmin.editDriverDetails')->with('dInfo',$dInfo);

    
    }

    public function deleteDetails($NIC)
    { 
       $dInfo=driverDetail::where('NIC','=',$NIC)->first();
       $dInfo->delete();
       return redirect()->route('zonalAdmin.driverDetails.index')->with('status',"Deleted Succesfully!");
    }

    public function editDriverDetails(Request $request, $NIC)
    {
            $driverInfo=driverDetail::where('NIC','=',$NIC)->first();
            $driverInfo->name=$request->input('name');
            $driverInfo->nameInt=$request->input('nameIn');
            $driverInfo->bday=$request->input('bday');
            $driverInfo->address=$request->input('address'); 
            $driverInfo->NIC=$request->input('NIC'); 
            $driverInfo->email=$request->input('email'); 
            $driverInfo->mobile=$request->input('mobile'); 
            $driverInfo->homeTel=$request->input('homeTel'); 
            $driverInfo->otherName=$request->input('OCName');
            $driverInfo->otherTel=$request->input('OCNumber'); 
            $driverInfo->MStatus=$request->input('mStatus');
            $driverInfo->zone=$request->input('zone');
            $driverInfo->regDate=$request->input('registeredDate');  
            $driverInfo->appointGrade=$request->input('appointGrade');  
            $driverInfo->currentGrade=$request->input('currentGrade');  
            $driverInfo->basicSalary=$request->input('BSalary');   
            $driverInfo->currentSalary=$request->input('CSalary');   
        

        if($request->hasfile('avatar')){
            $file=$request->file('avatar');
            $extension=$file->getClientOriginalExtension();
            $filename=time() . '.' . $extension;
            $file->move('img/',$filename);
            $driverInfo->avatar=$filename;
        }

      $rec1=driverWorkplace::where('id','=',$request->id)->first();
      $rec1->workPlace=$request->input('workPlace'); 
      $rec1->workFrom=$request->input('workFrom'); 
      $rec1->workTo=$request->input('workTo'); 
      
      $rec2=driverWorkplace::where('id','=',$request->id1)->first();
      $rec2->workPlace=$request->input('workPlace1'); 
      $rec2->workFrom=$request->input('workFrom1'); 
      $rec2->workTo=$request->input('workTo1');

      $rec3=driverWorkplace::where('id','=',$request->id2)->first();
      $rec3->workPlace=$request->input('workPlace2'); 
      $rec3->workFrom=$request->input('workFrom2'); 
      $rec3->workTo=$request->input('workTo2');

      $rec4=driverWorkplace::where('id','=',$request->id3)->first();
      $rec4->workPlace=$request->input('workPlace3'); 
      $rec4->workFrom=$request->input('workFrom3'); 
      $rec4->workTo=$request->input('workTo3');

      $rec5=driverWorkplace::where('id','=',$request->id4)->first();
      $rec5->workPlace=$request->input('workPlace4'); 
      $rec5->workFrom=$request->input('workFrom4'); 
      $rec5->workTo=$request->input('workTo4');
        

        $driverInfo->save() && $rec1->save() && $rec2->save() && $rec3->save() && $rec4->save() && $rec5->save();
        return redirect()->route('zonalAdmin.driverDetails.index')->with('status',"Edited Succesfully!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('zonalAdmin.insertDriverDetails');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $driverInfo=new driverDetail;
            $driverInfo->name=$request->input('name');
            $driverInfo->nameInt=$request->input('nameIn');
            $driverInfo->bday=$request->input('bday');
            $driverInfo->address=$request->input('address'); 
            $driverInfo->NIC=$request->input('NIC'); 
            $driverInfo->email=$request->input('email'); 
            $driverInfo->mobile=$request->input('mobile'); 
            $driverInfo->homeTel=$request->input('homeTel'); 
            $driverInfo->otherName=$request->input('OCName');
            $driverInfo->otherTel=$request->input('OCNumber'); 
            $driverInfo->MStatus=$request->input('mStatus');
            $driverInfo->zone=$request->input('zone');
            $driverInfo->regDate=$request->input('registeredDate');  
            $driverInfo->appointGrade=$request->input('appointGrade');  
            $driverInfo->currentGrade=$request->input('currentGrade');  
            $driverInfo->basicSalary=$request->input('BSalary');   
            $driverInfo->currentSalary=$request->input('CSalary');   
            
            $data=array(
                array("NIC"=>$request->input('NIC'),"workPlace"=>$request->input('PWP1'),"workFrom"=>$request->input('from1'),"workTo"=>$request->input('to1')),
                array("NIC"=>$request->input('NIC'),"workPlace"=>$request->input('PWP2'),"workFrom"=>$request->input('from2'),"workTo"=>$request->input('to2')),
                array("NIC"=>$request->input('NIC'),"workPlace"=>$request->input('PWP3'),"workFrom"=>$request->input('from3'),"workTo"=>$request->input('to3')),
                array("NIC"=>$request->input('NIC'),"workPlace"=>$request->input('PWP4'),"workFrom"=>$request->input('from4'),"workTo"=>$request->input('to4')),
                array("NIC"=>$request->input('NIC'),"workPlace"=>$request->input('PWP5'),"workFrom"=>$request->input('from5'),"workTo"=>$request->input('to5')),
            );

        if($request->hasfile('avatar')){
            $file=$request->file('avatar');
            $extension=$file->getClientOriginalExtension();
            $filename=time() . '.' . $extension;
            $file->move('img/',$filename);
            $driverInfo->avatar=$filename;
        }

         $driverInfo->save() && driverWorkplace::insert($data);
        return redirect()->route('zonalAdmin.driverDetails.index')->with('status',"Inserted Succesfully!");
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
