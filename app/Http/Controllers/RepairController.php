<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repair;
use App\Traits\HttpResponses;
use Validator;
use DB;

class RepairController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT `repair`.`id` AS `repair_id`,`repair`.* ,`printer_map`.* FROM `repair` LEFT JOIN `printer_map` ON `printer_map`.`id` = `repair`.`printer_id` ORDER BY `repair`.`id` DESC
    //    $repair = Repair::all();
        $allRepair = DB::table('repair')
        ->select('repair.id AS repair_id','repair.*','printer_map.*')
       ->join('printer_map','repair.printer_id','=','printer_map.id')
       ->orderBy('repair.id', 'DESC')
       ->get();
        return $this->success($allRepair,'Successful');
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
            'printer_id'=>'required',
            'amount'=>'required',
            'issue'=>'required',
            'repair'=>'required',
        ]);

        if($validated->fails()){
           
            return response()->json($validated->messages());
        }
        $createRepair = Repair::create([
            'printer_id' =>  $request->printer_id,
            'amount' =>  $request->amount,
            'issue' =>  $request->issue,
            'repair' =>  $request->repair,
        ]);
        // return $this->success($createRepair,'Successful');
        if($createRepair){
            return $this->success($createRepair,'Successful');
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

        $update = Repair::findOrfail($id);

        $transformData = $this->transformData($request->all());
       
        if($transformData){
            $update->amount = \json_encode($transformData['amount']);
            $update->issue = \json_encode($transformData['issue']);
            $update->repair = \json_encode($transformData['repair']);
            $update->save();
        }

        return $this->success($update,'Successful');
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
        $record = Repair::findOrFail($id);
        $record->delete();

        return $this->success($record,'Successful');


    }

    public function transformData($data)
    {
        $amount = $data['amount'];
        $issue = $data['issue'];
        $repair = $data['repair'];

        $id = intval($data['id']);
        $result = Repair::where('id', $data['id'])->first();

        $array1amount = json_decode($data['amount'], true);
        $array2amount = json_decode($result->amount, true);
        $updatedAmount = $array1amount + $array2amount;

        $array1issue = json_decode($data['issue'], true);
        $array2issue = json_decode($result->issue, true);
        $updatedIssue = $array1issue + $array2issue;

        $array1repair = json_decode($data['repair'], true);
        $array2repair = json_decode($result->repair, true);
        $updatedRepair = $array1repair + $array2repair;

        return array("amount" => $updatedAmount, "issue" => $updatedIssue, "repair" => $updatedRepair);
    }
}
