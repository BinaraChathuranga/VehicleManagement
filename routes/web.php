<?php
use App\district;
use App\branch;
use App\zone;
use App\User;
use App\vehicleDetail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});



Route::get('/reserve', function () {
    return view('reserve');
});



Auth::routes();

View::composer(['*'],function($view){
    $dis=district::all();
    $view->with('dis', $dis);
});

View::composer(['*'],function($view){
    $dis=zone::all();
    $view->with('zone', $dis);
});

View::composer(['*'],function($view){
    $dis=branch::all();
    $view->with('bra', $dis);
});

View::composer(['*'],function($view){
    $uInfo=User::all();
    $view->with('userInfo', $uInfo);
});

View::composer(['zonalAdmin.reserveVehicle'],function($view){
    $resVehicle=vehicleDetail::where('zone','=',Auth::user()->zone)->where('status','=','Available')
    ->get();
    $view->with('resVehicle',$resVehicle);
});

View::composer(['admin.reserveVehicle'],function($view){
    $resVehicle=vehicleDetail::where('zone','=',Auth::user()->zone)->where('status','=','Available')
    ->get();
    $view->with('resVehicle',$resVehicle);
});

View::composer(['director.reserveVehicle'],function($view){
    $dirResVehicle=vehicleDetail::where('zone','=',Auth::user()->zone)
    ->get();
    $view->with('DirResVehicle',$dirResVehicle);
});

// Inactive User
Route::get('/inactive', 'inactiveController@index')->name('inactive')->middleware('inactive');

// Admin
Route::get('/test', 'adminController@test')->name('test')->middleware('admin');

Route::get('/admin', 'adminController@index')->name('admin')->middleware('admin');
Route::get('/editRegUser/{id}', 'adminController@editRegUser')->name('editRegUser')->middleware('admin');
Route::post('/editedRegUser/{id}', 'adminController@editedRegUser')->name('editedRegUser')->middleware('admin');
Route::get('/viewRegUser/{id}', 'adminController@viewRegUser')->name('viewRegUser')->middleware('admin');

Route::resource('/admin/driverDetails', 'driverController',['as'=>'admin'])->middleware('admin');
Route::get('/admin/viewDriverDetails/{NIC}', 'driverController@viewDriverDetails')->middleware('admin');
Route::get('/admin/editDetails/{NIC}', 'driverController@editDetails')->middleware('admin');
Route::get('/admin/deleteDetails/{NIC}', 'driverController@deleteDetails')->middleware('admin');
Route::post('/admin/editDriverDetails/{NIC}', 'driverController@editDriverDetails')->middleware('admin');

Route::resource('/admin/vehicleDetails', 'vehicleController',['as'=>'admin'])->middleware('admin');
Route::get('/admin/viewVehicleDetails/{regNo}', 'vehicleController@viewVehicleDetails')->middleware('admin');
Route::get('/admin/editVDetails/{regNo}', 'vehicleController@editVDetails')->middleware('admin');
Route::get('/admin/deleteVDetails/{regNo}', 'vehicleController@deleteVDetails')->middleware('admin');
Route::post('/admin/editVehicleDetails/{regNo}', 'vehicleController@editVehicleDetails')->middleware('admin');

Route::get('/viewUserReservations', 'adminController@viewUserReservations')->name('viewUserReservation')->middleware('admin');
Route::post('/admin/confirmReservation/{id}', 'adminController@confirmReservation')->name('confirmReservation')->middleware('admin');
Route::get('/admin/viewPendingUserReservations', 'adminController@viewPendingReservations')->name('viewPendingReservation')->middleware('admin');
Route::get('/viewUserConfirmedReservations', 'adminController@viewConfirmedReservations')->name('viewConfirmedReservation')->middleware('admin');
Route::post('/admin/completeReservation/{id}', 'adminController@completeReservation')->name('completeReservation')->middleware('admin');
Route::get('/viewUserCompletedReservations', 'adminController@viewCompletedReservations')->name('viewCompletedReservation')->middleware('admin');
Route::get('/viewUserCancelledReservations', 'adminController@viewCancelledReservations')->name('viewCancelledReservation')->middleware('admin');
Route::get('/admin/viewAllReservations', 'adminController@reservationDetails')->name('reservationDetails')->middleware('admin');
Route::post('/admin/filterAllResDetails', 'adminController@filterAllResDetails')->name('filterAllResDetails')->middleware('admin');
Route::post('/admin/vehicleFilter', 'adminController@vehicleFilter')->name('vehicleFilter')->middleware('admin');

Route::get('/admin/NewReservation/{regNo}', 'adminController@newReservation')->name('adminnewReservation')->middleware('admin');
Route::post('/admin/reserve', 'adminController@reserve')->name('adminreserve')->middleware('admin');
Route::get('/admin/editReservation/{id}', 'adminController@editReservation')->name('admineditReservation')->middleware('admin');
Route::post('/admin/editReservationInfo/{regNo}', 'adminController@editReservationInfo')->name('admineditReservationInfo')->middleware('admin');
Route::post('/admin/editedReserve/{id}', 'adminController@editedReserve')->name('admineditedReserve')->middleware('admin');
Route::get('/admin/cancelReservation/{id}', 'adminController@cancelReservations')->name('admincancelReservations')->middleware('admin');

Route::get('/admin/runningChartVehicles', 'adminController@runningChartVehicles')->name('adminrunningChartVehicles')->middleware('admin');
Route::post('/admin/filterRuningChartVehicles', 'adminController@filterRuningChartVehicles')->name('adminfilterRuningChartVehicles')->middleware('admin');
Route::get('/admin/runnigChart/{regNo}', 'adminController@runnigChart')->name('adminrunnigChart')->middleware('admin');
Route::post('/admin/filterRunningChartDetails', 'adminController@filterRunningChartDetails')->name('adminfilterRunningChartDetails')->middleware('admin');

Route::get('/admin/vehicleServiceParts/{regNo}', 'adminController@vehicleServiceParts')->name('adminvehicleServiceParts')->middleware('admin');
Route::post('/admin/insertVehicleParts', 'adminController@insertVehicleParts')->name('admininsertVehicleParts')->middleware('admin');
Route::get('/admin/serviceVehicles', 'adminController@serviceVehicles')->name('adminserviceVehicles')->middleware('admin');
Route::post('/admin/filterServiceVehicles', 'adminController@filterServiceVehicles')->name('adminfilterServiceVehicles')->middleware('admin');
Route::get('/admin/viewVehicleParts/{regNo}', 'adminController@viewVehicleParts')->name('adminviewVehicleParts')->middleware('admin');
Route::post('/admin/addServiceDetails', 'adminController@addServiceDetails')->name('adminaddServiceDetails')->middleware('admin');
Route::post('/admin/ServicedDetails', 'adminController@ServicedDetails')->name('adminServicedDetails')->middleware('admin');
Route::post('/admin/extendMileage', 'adminController@extendMileage')->name('adminextendMileage')->middleware('admin');
Route::post('/admin/editPartsDetails', 'adminController@editPartsDetails')->name('admineditPartsDetails')->middleware('admin');
Route::get('/admin/viewServiceDetails/{regNo}', 'adminController@viewServiceDetails')->name('adminviewServiceDetails')->middleware('admin');
Route::post('/admin/filterServiceDetails', 'adminController@filterServiceDetails')->name('adminfilterServiceDetails')->middleware('admin');

Route::get('/admin/newUserReservation', 'adminController@newUserReservation')->name('adminnewUserReservation')->middleware('admin');
Route::post('/admin/newReserve', 'adminController@newReserve')->name('adminnewReserve')->middleware('admin');
Route::post('/admin/resFuelConsumption', 'adminController@resFuelConsumption')->name('adminresFuelConsumption')->middleware('admin');
Route::get('/admin/fuelConsumptionVehicles', 'adminController@fuelConsumptionVehicles')->name('adminfuelConsumptionVehicles')->middleware('admin');
Route::post('/admin/filterFuelVehicles', 'adminController@filterFuelVehicles')->name('adminfilterFuelVehicles')->middleware('admin');
Route::get('/admin/vehFuelConsumption/{regNo}', 'adminController@vehFuelConsumption')->name('adminvehFuelConsumption')->middleware('admin');
Route::post('/admin/filterFuelConsumption', 'adminController@filterFuelConsumption')->name('adminfilterFuelConsumption')->middleware('admin');
Route::get('/admin/viewRefillDetails/{regNo}', 'adminController@viewRefillDetails')->name('adminviewRefillDetails')->middleware('admin');
Route::post('/admin/filterFuelRefill', 'adminController@filterFuelRefill')->name('adminfilterFuelRefill')->middleware('admin');
Route::post('/admin/refillFuel', 'adminController@refillFuel')->name('adminrefillFuel')->middleware('admin');

Route::get('/admin/reportsVehicles', 'adminController@reportsVehicles')->name('adminreportsVehicles')->middleware('admin');
Route::post('/admin/filterReportsVehicles', 'adminController@filterReportsVehicles')->name('adminfilterReportsVehicles')->middleware('admin');
Route::get('/admin/viewReportVehicleDetails/{regNo}', 'adminController@viewReportVehicleDetails')->name('adminviewReportVehicleDetails')->middleware('admin');
Route::post('/admin/filterVehiclesReport', 'adminController@filterVehiclesReport')->name('adminfilterVehiclesReport')->middleware('admin');
Route::get('/admin/vehicleDetailsReport', 'adminController@vehicleDetailsReport')->name('adminvehicleDetailsReport')->middleware('admin');

Route::get('/admin/driverDetailsReport', 'adminController@driverDetailsReport')->name('adminDriverDetailsReport')->middleware('admin');
Route::post('/admin/filterDriverReport', 'adminController@filterDriverReport')->name('adminfilterDriverReport')->middleware('admin');
Route::get('/admin/viewDriverDetailsReport/{NIC}', 'adminController@viewDriverDetailsReport')->name('adminviewDriverDetailsReport')->middleware('admin');

Route::get('/admin/repair', 'adminController@repair')->name('adminrepair')->middleware('admin');
Route::post('/admin/filterRepairsVehicles', 'adminController@filterRepairVehicles')->name('adminfilterRepairVehicles')->middleware('admin');
Route::get('/admin/viewRepairDetails/{regNo}', 'adminController@viewRepairDetails')->name('adminviewRepairDetails')->middleware('admin');
Route::post('/admin/filterRepairDetails', 'adminController@filterRepairDetails')->name('adminfilterRepairDetails')->middleware('admin');
Route::get('/admin/completeRepair/{regNo}', 'adminController@completeRepair')->name('admincompleteRepair')->middleware('admin');
Route::post('/admin/completedRepair', 'adminController@completedRepair')->name('admincompletedRepair')->middleware('admin');
Route::post('/admin/addRepairDetails', 'adminController@addRepairDetails')->name('adminaddRepairDetails')->middleware('admin');

Route::get('/changeVehicle/{reserveDate}', 'adminController@changeVehicle')->name('changeVehicle')->middleware('admin');

// Director
Route::get('/director', 'directorController@index')->name('director')->middleware('director');
Route::post('/dirEditProfile/{id}', 'directorController@dirEditProfile')->name('dirEditProfile')->middleware('director');
Route::get('/director/driverDetails', 'directorController@driverDetails')->name('directorDriverDetails')->middleware('director');
Route::get('/director/viewDriverDetails/{NIC}', 'directorController@viewDriverDetails')->name('directorViewDriverDetails')->middleware('director');
Route::get('/director/vehicleDetails', 'directorController@vehicleDetails')->name('directorVehicleDetails')->middleware('director');
Route::get('/director/viewVehicleDetails/{regNo}', 'directorController@viewVehicleDetails')->name('directorViewVehicleDetails')->middleware('director');
Route::get('/director/reports', 'directorController@reports')->name('directorReports')->middleware('director');
Route::get('/director/reserveVehicle', 'directorController@reserveVehicle')->name('directorReserveVehicle')->middleware('director');
Route::get('/director/regUsers', 'directorController@regUsers')->name('directorRegUsers')->middleware('director');
Route::get('/directorNewReservation/{regNo}', 'directorController@newReservation')->name('directornewReservation')->middleware('director');
Route::post('/director/reserve', 'directorController@reserve')->name('directorReserve')->middleware('director');
Route::get('/director/reservationDetails', 'directorController@reservationDetails')->name('directorReservationDetails')->middleware('director');
Route::post('/director/filterDirResDetails', 'directorController@filterResDirDetails')->name('filterResDirDetails')->middleware('director');
Route::get('/director/myReservations', 'directorController@myReservations')->name('directormyReservations')->middleware('director');

Route::post('/director/filterFuelVehicles', 'directorController@filterFuelVehicles')->name('directorfilterFuelVehicles')->middleware('director');
Route::get('/director/fuelConsumptionVehicles', 'directorController@fuelConsumptionVehicles')->name('directorfuelConsumptionVehicles')->middleware('director');
Route::get('/director/vehFuelConsumption/{regNo}', 'directorController@vehFuelConsumption')->name('directorvehFuelConsumption')->middleware('director');
Route::post('/director/filterFuelConsumption', 'directorController@filterFuelConsumption')->name('directorfilterFuelConsumption')->middleware('director');
Route::get('/director/viewRefillDetails/{regNo}', 'directorController@viewRefillDetails')->name('directorviewRefillDetails')->middleware('director');
Route::post('/director/filterFuelRefill', 'directorController@filterFuelRefill')->name('directorfilterFuelRefill')->middleware('director');

Route::get('/director/serviceDetailsVehicles', 'directorController@serviceDetailsVehicles')->name('directorserviceDetailsVehicles')->middleware('director');
Route::post('/director/filterServiceVehicles', 'directorController@filterServiceVehicles')->name('directorfilterServiceVehicles')->middleware('director');
Route::get('/director/viewVehicleParts/{regNo}', 'directorController@viewVehicleParts')->name('directorviewVehicleParts')->middleware('director');
Route::get('/director/viewServiceDetails/{regNo}', 'directorController@viewServiceDetails')->name('directorviewServiceDetails')->middleware('director');
Route::post('/director/filterServiceDetails', 'directorController@filterServiceDetails')->name('directorfilterServiceDetails')->middleware('director');

Route::get('/director/runningChartVehicles', 'directorController@runningChartVehicles')->name('directorrunningChartVehicles')->middleware('director');
Route::post('/director/filterRuningChartVehicles', 'directorController@filterRuningChartVehicles')->name('directorfilterRuningChartVehicles')->middleware('director');
Route::get('/director/runnigChart/{regNo}', 'directorController@runnigChart')->name('directorrunnigChart')->middleware('director');
Route::post('/director/filterRunningChartDetails', 'directorController@filterRunningChartDetails')->name('directorfilterRunningChartDetails')->middleware('director');

Route::get('/director/reportsVehicles', 'directorController@reportsVehicles')->name('directorreportsVehicles')->middleware('director');
Route::post('/director/filterReportsVehicles', 'directorController@filterReportsVehicles')->name('directorfilterReportsVehicles')->middleware('director');
Route::get('/director/viewReportVehicleDetails/{regNo}', 'directorController@viewReportVehicleDetails')->name('directorviewReportVehicleDetails')->middleware('director');

Route::post('/director/filterVehiclesReport', 'directorController@filterVehiclesReport')->name('directorfilterVehiclesReport')->middleware('director');
Route::post('/director/filterDriverReport', 'directorController@filterDriverReport')->name('directorfilterDriverReport')->middleware('director');

Route::get('/director/userReservations', 'directorController@userReservations')->name('directoruserReservations')->middleware('director');
Route::post('/director/approveReservation/{id}', 'directorController@approveReservation')->name('directorapproveReservation')->middleware('director');
Route::post('/director/cancelReservation/{id}', 'directorController@cancelReservation')->name('directorcancelReservation')->middleware('director');


Route::get('/director/repair', 'directorController@repair')->name('directorrepair')->middleware('director');
Route::post('/director/filterRepairsVehicles', 'directorController@filterRepairVehicles')->name('directorfilterRepairVehicles')->middleware('director');
Route::get('/director/viewRepairDetails/{regNo}', 'directorController@viewRepairDetails')->name('directorviewRepairDetails')->middleware('director');
Route::post('/director/filterRepairDetails', 'directorController@filterRepairDetails')->name('directorfilterRepairDetails')->middleware('director');




// Zonal Admin
Route::get('/zonalAdmin', 'zonalAdmin\zonalAdminController@index')->name('zonalAdmin')->middleware('zonalAdmin');
Route::get('/zonalAdmin/editRegUser/{id}', 'zonalAdmin\zonalAdminController@editRegUser')->name('editRegUser')->middleware('zonalAdmin');
Route::post('/zonalAdmin/editedRegUser/{id}', 'zonalAdmin\zonalAdminControllerr@editedRegUser')->name('editedRegUser')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewRegUser/{id}', 'zonalAdmin\zonalAdminController@viewRegUser')->name('viewRegUser')->middleware('zonalAdmin');

Route::resource('/zonalAdmin/driverDetails', 'zonalAdmin\driverController',['as'=>'zonalAdmin'])->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewDriverDetails/{NIC}', 'zonalAdmin\driverController@viewDriverDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/editDetails/{NIC}', 'zonalAdmin\driverController@editDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/deleteDetails/{NIC}', 'zonalAdmin\driverController@deleteDetails')->middleware('zonalAdmin');
Route::post('/zonalAdmin/editDriverDetails/{NIC}', 'zonalAdmin\driverController@editDriverDetails')->middleware('zonalAdmin');

Route::resource('/zonalAdmin/vehicleDetails', 'zonalAdmin\vehicleController',['as'=>'zonalAdmin'])->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewVehicleDetails/{regNo}', 'zonalAdmin\vehicleController@viewVehicleDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/editVDetails/{regNo}', 'zonalAdmin\vehicleController@editVDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/deleteVDetails/{regNo}', 'zonalAdmin\vehicleController@deleteVDetails')->middleware('zonalAdmin');
Route::post('/zonalAdmin/editVehicleDetails/{regNo}', 'zonalAdmin\vehicleController@editVehicleDetails')->middleware('zonalAdmin');

Route::get('/zonalAdmin/viewUserReservations', 'zonalAdmin\zonalAdminController@viewUserReservations')->name('zonalAdminviewUserReservation')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewPendingUserReservations', 'zonalAdmin\zonalAdminController@viewPendingReservations')->name('zonalAdminviewPendingReservation')->middleware('zonalAdmin');
Route::post('/zonalAdmin/confirmReservation/{id}', 'zonalAdmin\zonalAdminController@confirmReservation')->name('zonalAdminconfirmReservation')->middleware('zonalAdmin');
Route::get('/zonalAdmin/NewReservation/{regNo}', 'zonalAdmin\zonalAdminController@newReservation')->name('newReservation')->middleware('zonalAdmin');
Route::post('/zonalAdmin/reserve', 'zonalAdmin\zonalAdminController@reserve')->name('reserve')->middleware('zonalAdmin');
Route::get('/zonalAdmin/editReservation/{id}', 'zonalAdmin\zonalAdminController@editReservation')->name('editReservation')->middleware('zonalAdmin');
Route::post('/zonalAdmin/editReservationInfo/{regNo}', 'zonalAdmin\zonalAdminController@editReservationInfo')->name('editReservationInfo')->middleware('zonalAdmin');
Route::post('/zonalAdmin/editedReserve/{id}', 'zonalAdmin\zonalAdminController@editedReserve')->name('editedReserve')->middleware('zonalAdmin');
Route::get('/zonalAdmin/cancelReservation/{id}', 'zonalAdmin\zonalAdminController@cancelReservations')->name('zonalAdmincancelReservations')->middleware('zonalAdmin');

Route::get('/zonalAdmin/viewUserConfirmedReservations', 'zonalAdmin\zonalAdminController@viewConfirmedReservations')->name('zonalAdminviewConfirmedReservation')->middleware('zonalAdmin');
Route::post('/zonalAdmin/completeReservation/{id}', 'zonalAdmin\zonalAdminController@completeReservation')->name('zonalAdmincompleteReservation')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewUserCompletedReservations', 'zonalAdmin\zonalAdminController@viewCompletedReservations')->name('zonalAdminviewCompletedReservation')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewUserCancelledReservations', 'zonalAdmin\zonalAdminController@viewCancelledReservations')->name('zonalAdminviewCancelledReservation')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewAllReservations', 'zonalAdmin\zonalAdminController@reservationDetails')->name('zonalAdminreservationDetails')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterAllResDetails', 'zonalAdmin\zonalAdminController@filterAllResDetails')->name('zonalAdminfilterAllResDetails')->middleware('zonalAdmin');

Route::get('/zonalAdmin/fuelConsumptionVehicles', 'zonalAdmin\zonalAdminController@fuelConsumptionVehicles')->name('fuelConsumptionVehicles')->middleware('zonalAdmin');
Route::post('/zonalAdmin/refillFuel', 'zonalAdmin\zonalAdminController@refillFuel')->name('refillFuel')->middleware('zonalAdmin');
Route::post('/zonalAdmin/resFuelConsumption', 'zonalAdmin\zonalAdminController@resFuelConsumption')->name('resFuelConsumption')->middleware('zonalAdmin');
Route::get('/zonalAdmin/vehFuelConsumption/{regNo}', 'zonalAdmin\zonalAdminController@vehFuelConsumption')->name('vehFuelConsumption')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewRefillDetails/{regNo}', 'zonalAdmin\zonalAdminController@viewRefillDetails')->name('viewRefillDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/vehicleServiceParts/{regNo}', 'zonalAdmin\zonalAdminController@vehicleServiceParts')->name('zonalAdminvehicleServiceParts')->middleware('zonalAdmin');
Route::post('/zonalAdmin/editPartsDetails', 'zonalAdmin\zonalAdminController@editPartsDetails')->name('editPartsDetails')->middleware('zonalAdmin');

Route::post('/zonalAdmin/insertVehicleParts', 'zonalAdmin\zonalAdminController@insertVehicleParts')->name('insertVehicleParts')->middleware('zonalAdmin');
Route::get('/zonalAdmin/serviceVehicles', 'zonalAdmin\zonalAdminController@serviceVehicles')->name('serviceVehicles')->middleware('zonalAdmin');

Route::get('/zonalAdmin/repairDetails/{regNo}', 'zonalAdmin\zonalAdminController@repairDetails')->name('repairDetails')->middleware('zonalAdmin');

Route::get('/zonalAdmin/viewVehicleParts/{regNo}', 'zonalAdmin\zonalAdminController@viewVehicleParts')->name('viewVehicleParts')->middleware('zonalAdmin');
Route::post('/zonalAdmin/extendMileage', 'zonalAdmin\zonalAdminController@extendMileage')->name('extendMileage')->middleware('zonalAdmin');
Route::post('/zonalAdmin/addServiceDetails', 'zonalAdmin\zonalAdminController@addServiceDetails')->name('addServiceDetails')->middleware('zonalAdmin');
Route::post('/zonalAdmin/ServicedDetails', 'zonalAdmin\zonalAdminController@ServicedDetails')->name('ServicedDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewServiceDetails/{regNo}', 'zonalAdmin\zonalAdminController@viewServiceDetails')->name('viewServiceDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/runningChartVehicles', 'zonalAdmin\zonalAdminController@runningChartVehicles')->name('runningChartVehicles')->middleware('zonalAdmin');
Route::get('/zonalAdmin/runnigChart/{regNo}', 'zonalAdmin\zonalAdminController@runnigChart')->name('runnigChart')->middleware('zonalAdmin');


Route::get('/zonalAdmin/newUserReservation', 'zonalAdmin\zonalAdminController@newUserReservation')->name('zonalnewUserReservation')->middleware('zonalAdmin');
Route::post('/zonalAdmin/newReserve', 'zonalAdmin\zonalAdminController@newReserve')->name('zonalnewReserve')->middleware('zonalAdmin');

Route::get('/zonalAdmin/reportsVehicles', 'zonalAdmin\zonalAdminController@reportsVehicles')->name('zonalreportsVehicles')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterReportsVehicles', 'zonalAdmin\zonalAdminController@filterReportsVehicles')->name('zonalfilterReportsVehicles')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewReportVehicleDetails/{regNo}', 'zonalAdmin\zonalAdminController@viewReportVehicleDetails')->name('zonalviewReportVehicleDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/vehicleDetailsReport', 'zonalAdmin\zonalAdminController@vehicleDetailsReport')->name('zonalvehicleDetailsReport')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterVehiclesReport', 'zonalAdmin\zonalAdminController@filterVehiclesReport')->name('zonalfilterVehiclesReport')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterFuelConsumption', 'zonalAdmin\zonalAdminController@filterFuelConsumption')->name('zonalfilterFuelConsumption')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterFuelRefill', 'zonalAdmin\zonalAdminController@filterFuelRefill')->name('zonalfilterFuelRefill')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterServiceDetails', 'zonalAdmin\zonalAdminController@filterServiceDetails')->name('zonalfilterServiceDetails')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterRunningChartDetails', 'zonalAdmin\zonalAdminController@filterRunningChartDetails')->name('zonalfilterRunningChartDetails')->middleware('zonalAdmin');

Route::get('/zonalAdmin/driverDetailsReport', 'zonalAdmin\zonalAdminController@driverDetailsReport')->name('zonalDriverDetailsReport')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewDriverDetailsReport/{NIC}', 'zonalAdmin\zonalAdminController@viewDriverDetailsReport')->name('zonalviewDriverDetailsReport')->middleware('admin');

Route::get('/zonalAdmin/repair', 'zonalAdmin\zonalAdminController@repair')->name('repair')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterRepairsVehicles', 'zonalAdmin\zonalAdminController@filterRepairVehicles')->name('zonalfilterRepairVehicles')->middleware('zonalAdmin');
Route::post('/zonalAdmin/addRepairDetails', 'zonalAdmin\zonalAdminController@addRepairDetails')->name('zonaladdRepairDetails')->middleware('zonalAdmin');
Route::get('/zonalAdmin/completeRepair/{regNo}', 'zonalAdmin\zonalAdminController@completeRepair')->name('zonalcompleteRepair')->middleware('zonalAdmin');
Route::post('/zonalAdmin/completedRepair', 'zonalAdmin\zonalAdminController@completedRepair')->name('zonalcompletedRepair')->middleware('zonalAdmin');
Route::get('/zonalAdmin/viewRepairDetails/{regNo}', 'zonalAdmin\zonalAdminController@viewRepairDetails')->name('zonalviewRepairDetails')->middleware('zonalAdmin');
Route::post('/zonalAdmin/filterRepairDetails', 'zonalAdmin\zonalAdminController@filterRepairDetails')->name('zonalfilterRepairDetails')->middleware('zonalAdmin');

// User
Route::get('/user', 'userController@index')->name('user')->middleware('user');
Route::post('/user/reserve', 'userController@reserve')->name('reserve')->middleware('user');
Route::get('/user/myReservations', 'userController@myReservations')->name('myReservations')->middleware('user');
Route::post('/user/cancelMyReservation/{id}', 'userController@cancelMyReservations')->name('cancelMyReservations')->middleware('user');
Route::get('/user/pendingReservations', 'userController@pendingReservations')->name('pendingReservations')->middleware('user');
Route::get('/user/viewPendingReservations/{id}', 'userController@viewPendingReservations')->name('viewPendingReservations')->middleware('user');
Route::get('/json-getmprice', 'userController@getMprice')->name('getMprice');

Route::get('/user/resCalender/{regNo}', 'userController@newResCalender')->name('newResCalender')->middleware('user');
Route::post('/user/storeEvent','userController@storeEvent')->name('storeEvent');
Route::get('/userDynamic','userController@dynamic')->name('dynamic');
Route::post('/user/filterAllResDetails', 'userController@filterAllResDetails')->name('userfilterAllResDetails')->middleware('user');

Route::get('/json-getzone', 'HomeController@getzone');
Route::get('/json-getbranch', 'HomeController@getbranch');
Route::get('/json-getvId', 'zonalAdmin\zonalAdminController@getvpId');
Route::get('/complete', 'HomeController@complete');
Route::post('/completeUser/{id}', 'HomeController@completeUser');
Route::get('/home', 'HomeController@index')->name('home')->middleware('admin');

// manager
Route::get('/manager', 'manager\managerController@index')->name('manager')->middleware('manager');
Route::post('/manager/approveReservation/{id}', 'manager\managerController@approveReservation')->name('approveReservation')->middleware('manager');
Route::get('/manager/cancelReservation/{id}', 'manager\managerController@cancelReservation')->name('cancelReservation')->middleware('manager');
Route::get('/manager/cancelledReservations', 'manager\managerController@cancelledReservations')->name('managercancelledReservations')->middleware('manager');
Route::get('/manager/approvedReservations', 'manager\managerController@approvedReservations')->name('managerapprovedReservations')->middleware('manager');
