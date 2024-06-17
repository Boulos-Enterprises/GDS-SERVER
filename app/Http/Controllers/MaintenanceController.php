<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Traits\HttpResponses;
use Validator;
use DB;
class MaintenanceController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = Maintenance::all();
        $allMaintenance = DB::table('maintenance')
        ->select('maintenance.id AS maintenance_id','maintenance.*','printer_map.*','printer_user.first_name','printer_user.last_name','maintenance_type.*')
       ->join('printer_map','maintenance.printer_id','=','printer_map.id')
       ->join('printer_user','printer_map.id','=','printer_user.id')
       ->join('maintenance_type','maintenance.maintenance_type_id','=','maintenance_type.id')
       ->orderBy('maintenance.id', 'DESC')
       ->get();
        return $this->success($allMaintenance,'Successful');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
