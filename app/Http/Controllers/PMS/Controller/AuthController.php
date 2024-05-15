<?php

namespace App\Http\Controllers\PMS\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\PMS\User;
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
        $validated = Validator($request->all(),[
            'username'=>'required',
            'password'=>'required',
            'role'=>'required'

        ]);

        if($validated->fails()){
           
            return response()->json($validated->messages());
        }
       
        $user = User::create([
           'username' =>  $request->username ,
           'password'=>Hash::make($request->password),
           'firstname'=>$request->firstname,
           'lastname'=>$request->lastname,
           'email'=>$request->email
        ]);
        $user->assignRole($request->role);
        return $this->success($user,"Successfully Created");

    }
}
