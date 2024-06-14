<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Schema;
use App\Models\Department;
use App\Models\PrinterUser;
use DB;

class GeneralController extends Controller
{
    //
    use HttpResponses;

    public function dynamicFetch($tableName,$selectedColumn){
   
        try {
            // Check if the requested table exists in the database
            if (Schema::hasTable($tableName)) {
                // Get the selected columns from the request
                $selectedColumns = explode(',', $selectedColumn);

                // Build the query
                $query = DB::table($tableName)
                    ->select($selectedColumns);

                // Execute the query and get the results
                $results = $query->get();

                // Return the results as a JSON response
                return response()->json($results);
            } else {
                // Return an error response if the table does not exist
                return response()->json(['error' => 'Table not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that might occur
            return response()->json(['error' => $e->getMessage()], 500);
        }

        
    }

    public function getdepartmentbycompany($companyId){
        $department = Department::where('company_id',$companyId)->get();
        return $this->success($department,'Successful');
    }

    public function getuserbydepartment($departmentId){
        $user = PrinterUser::where('department_id',$departmentId)->get();
        return $this->success($user,'Successful');
    }

}