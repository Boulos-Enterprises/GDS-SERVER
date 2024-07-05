<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrinterUser;
use Validator;
use App\Traits\HttpResponses;

class PmsUser extends Controller
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
            'last_name'=>'required',
            'first_name'=>'required',
            'department_id'=>'required',
            'company_id'=>'required'
        ]);
        if($validated->fails()){
           
            return response()->json($validated->messages());
        }

        $createPrinterUser = PrinterUser::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'department_id'=>$request->department_id,
            'company_id'=>$request->company_id
        ]);

        return $this->success($createPrinterUser,'Successful');

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
        $printeruser = PrinterUser::findOrFail($id);
        $printeruser->update($request->all());

        return $this->success($printeruser,'Successful');

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
        $printeruser = PrinterUser::findOrFail($id);
        $printeruser->delete();
        return $this->success($printeruser,'Successful');
    }
}
