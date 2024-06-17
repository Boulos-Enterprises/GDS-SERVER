<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PMS\Controller\AuthController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MaintenanceController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//General Route

Route::get('/',function(){
    return array("message"=>"Welcome to GDS SERVER API");
});
Route::get('app/dynamic_read/{tableName}/{selectedColumns}',[GeneralController::class,'dynamicFetch']);
Route::get('app/company/getdepartments/{companyId}',[GeneralController::class,'getdepartmentbycompany']);
Route::get('app/department/getuser/{departmentId}',[GeneralController::class,'getuserbydepartment']);

//PMS ENDPOINTS
Route::resource('/roles',RolesController::class);

Route::resource('/permission',PermissionController::class);

Route::post('/create_superadmin',[AuthController::class,'register']);

Route::post('/token/sanctum',[AuthController::class,'checklogin']);

Route::resource('/printer',PrinterController::class);
Route::resource('/repair',RepairController::class);
Route::resource('/maintenance',MaintenanceController::class);



//MMS END POINT



