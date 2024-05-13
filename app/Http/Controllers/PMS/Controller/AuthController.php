<?php

namespace App\Http\Controllers\PMS\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Validator;
use Hash;
use Auth;
class AuthController extends Controller
{
    //
    use HttpResponses;

    public function checklogin(Request $request){
        $validated = Validator($request->all(),[
            'username'=>'required',
            'password'=>'required'
        ]);

        if($validated->fails()){
           
            return response()->json($validated->messages());
        }

        if(!Auth::attempt($request->only('username','password'))){
            return $this->error("","Credential Error",401);
        }

        $user = User::where('username',$request->username)->first();
        return $this->success([
            "user"=>$user,
            "token"=>$user->createToken('Apitoken'.$user->username)->plainTextToken,
            "role"=>$user->getRoleNames()
        ]);

    }

    public function register(Request $request){
        
    }
}
