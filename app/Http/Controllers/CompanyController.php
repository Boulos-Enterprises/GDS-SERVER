<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Printer;
use Illuminate\Http\Request;
use Validator;
use App\Traits\HttpResponses;

class CompanyController extends Controller
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
            'company_name'=>'required',    
        ]);
        if($validated->fails()){
           
            return response()->json($validated->messages());
        }

        $createCompany = Company::create([
            'company_name'=>$request->company_name
        ]);
        return $this->success([$createCompany]);


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
        $company = Company::findOrFail($id);
        $company->update($request->all());

        return $this->success($company,'Successful');
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
        $check = Printer::where('company_id',$id)->first();
        if($check){
            return $this->error('You cannot Delete');
        }
        else{
            $company = Company::findOrFail($id);
            $company->delete();
            return $this->success($company,'Successful');
        }
        

    }
}
