<?php

namespace App\Http\Controllers\PMS\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\PMS\User;
use Validator;
use Hash;
use Auth;
use DB;
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

        
        $menu_auth = DB::table('authorization')
        ->select('auth_view')
        ->where('user_id',$user->id)->first();
       
        $menu = $this->menuItems($user->id);

    
        return $this->success([
            "menuitems"=>$menu,
            "menu"=>$menu_auth,
            "user"=>$user,
            "token"=>$user->createToken('Apitoken'.$user->username)->plainTextToken,
            "role"=>$user->getRoleNames()
        ]);

    }

    public function menuItems($userId){

        $menuItems = DB::table('menuitem')
        ->join('menu_group', 'menuitem.group_id', '=', 'menu_group.id')
        ->join('authorization','authorization.user_id', '=', DB::raw($userId))
        ->leftJoin('menuitem_children', function($join) {
            $join->on(DB::raw("JSON_CONTAINS(menuitem.children, CAST(menuitem_children.id AS CHAR))"), '=', DB::raw('true'));
        })
         ->whereRaw("JSON_CONTAINS(authorization.auth_view, CAST(menuitem.id AS CHAR))")
        ->select(
            'menu_group.group_name', 
            DB::raw('GROUP_CONCAT(menuitem.menuitem_name) as items'),
            DB::raw('GROUP_CONCAT(menuitem.link) as link'),
            DB::raw('GROUP_CONCAT(CONCAT(menuitem_children.menu_item_name, " - ", menuitem.menuitem_name)) as child_links')
        )
        ->groupBy('menu_group.group_name')
        ->get();

        return $menuItems;
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
