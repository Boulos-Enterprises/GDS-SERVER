<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Schema;
use App\Models\Department;
use App\Models\PrinterUser;
use DB;

class PmsDepartment extends Controller
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
        $validated = Validator($request->all(),[
            'department_name'=>'required',
            'company_id'=>'required'
        ]);
        if($validated->fails()){
           
            return response()->json($validated->messages());
        }

        $createDepartment = Department::create([
            "department_name"=>$request->department_name,
            "company_id"=>$request->company_id
        ]);

        return $this->success($createDepartment,'Successful');

        



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
        
        $department = Department::findOrFail($id);
        $department->update($request->all());

        return $this->success($department,'Successful');
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
        $department = Department::findOrFail($id);
        $department->delete();
        return $this->success($department,'Successful');
    }
}
