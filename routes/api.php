<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PMS\Controller\AuthController;

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

Route::resource('/roles',RolesController::class);

Route::resource('/permission',PermissionController::class);

Route::post('/create_superadmin',[AuthController::class,'register']);

Route::post('/token/sanctum',[AuthController::class,'checklogin']);



