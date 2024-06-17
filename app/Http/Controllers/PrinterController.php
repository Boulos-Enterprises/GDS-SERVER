<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Printer;
use App\Traits\HttpResponses;
use Validator;
use DB;

class PrinterController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         $allprinter = DB::table('printer_map')
         ->select('printer_map.id AS printer_id','department.*','printer_user.*','company.*','printer_type.*','printer_brand.*','printer_map.*')
        ->join('department','department.id','=','printer_map.department_id')
        ->join('printer_user','printer_user.id','=','printer_map.printer_user_id')
        ->join('company','company.id','=','printer_map.company_id')
        ->join('printer_type','printer_type.id','printer_map.printer_type_id')
        ->join('printer_brand','printer_brand.id','printer_map.printer_brand_id')
        ->orderBy('printer_map.id', 'DESC')
        
        ->get();


        return $this->success($allprinter,"Successful");
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
            'company_id'=>'required',
            'department_id'=>'required',
            'printer_user_id'=>'required',
            'printer_type_id'=>'required',
            'printer_name'=>'required',
            'printer_brand_id'=>'required',
            'serial_number'=>'required'
        ]);

        if($validated->fails()){
           
            return response()->json($validated->messages());
        }

        $printer = Printer::create([
            
            'company_id' =>  $request->company_id ,
            'department_id'=>$request->department_id ,
            'printer_name'=>$request->printer_name,
            'printer_brand_id'=>$request->printer_brand_id,
            'printer_type_id'=>$request->printer_type_id,
            'printer_user_id'=>$request->printer_user_id,
            'comment'=>$request->comment,
            'serial_number'=>$request->serial_number
             
        ]);

        if($printer){
            return $this->success($printer,'Successful');
        }
        else{
            return $this->error('','An Error Occurred');
        }



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
        $update = Printer::findOrfail($id);
      
    
        return $this->success($request->input('printer_name'),'Successful');
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
