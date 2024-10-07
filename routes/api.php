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
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PmsBrand;
use App\Http\Controllers\PmsBrandType;
use App\Http\Controllers\PmsUser;
use App\Http\Controllers\PmsDepartment;




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
Route::get('app/dynamic_read/{tableName}/{selectedColumns}',[GeneralController::class,'dynamicFetch'])->middleware(['auth:sanctum']);
Route::get('app/company/getdepartments/{companyId}',[GeneralController::class,'getdepartmentbycompany'])->middleware(['auth:sanctum']);
Route::get('app/department/getuser/{departmentId}',[GeneralController::class,'getuserbydepartment'])->middleware(['auth:sanctum']);
Route::get('app/department',[GeneralController::class,'department'])->middleware(['auth:sanctum'])->middleware(['auth:sanctum']);
Route::get('app/printer_user',[GeneralController::class,'PrinterUser'])->middleware(['auth:sanctum'])->middleware(['auth:sanctum']);

//PMS ENDPOINTS
Route::resource('/roles',RolesController::class)->middleware(['auth:sanctum']);
Route::get('/checkToken',[GeneralController::class,'checkToken'])->middleware(['auth:sanctum']);

Route::resource('/permission',PermissionController::class)->middleware(['auth:sanctum']);

Route::post('/create_superadmin',[AuthController::class,'register']);

Route::post('/token/sanctum',[AuthController::class,'checklogin']);

Route::post('/getMenu',[AuthController::class,'getMenu'])->middleware(['auth:sanctum']);

Route::post('/printer/update/{id}',[PrinterController::class,'updatePrinter'])->middleware(['auth:sanctum']);
Route::resource('/printer',PrinterController::class)->middleware(['auth:sanctum']);
Route::resource('/repair',RepairController::class)->middleware(['auth:sanctum']);
Route::resource('/maintenance',MaintenanceController::class)->middleware(['auth:sanctum']);
Route::resource('/company',CompanyController::class)->middleware(['auth:sanctum']);
Route::resource('/printeruser',PmsUser::class)->middleware(['auth:sanctum']);
Route::resource('/brand',PmsBrand::class)->middleware(['auth:sanctum']);
Route::resource('/brandtype',PmsBrandType::class)->middleware(['auth:sanctum']);
Route::resource('/department',PmsDepartment::class)->middleware(['auth:sanctum']);




//MMS END POINT



