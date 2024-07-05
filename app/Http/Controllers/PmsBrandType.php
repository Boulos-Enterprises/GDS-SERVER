<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandType;
use Validator;
use App\Traits\HttpResponses;

class PmsBrandType extends Controller
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
            'printer_type'=>'required',
            
        ]);
        if($validated->fails()){
           
            return response()->json($validated->messages());
        }

        $createPrinterType = BrandType::create([
            'printer_type'=>$request->printer_type,
            
        ]);

        return $this->success($createPrinterType,'Successful');
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
        $brand = BrandType::findOrFail($id);
        $brand->update($request->all());

        return $this->success($brand,'Successful');
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
        $brandType = BrandType::findOrFail($id);
        $brandType->delete();
        return $this->success($brandType,'Successful');
    }
}
