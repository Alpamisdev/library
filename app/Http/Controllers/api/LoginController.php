<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
//    public function register(Request $request){
//        $validator = Validator::make($request->all(), [
//            'name'=>'required',
//            'group_id'=>'required|exists:App\Models\Group,id',
//            'phone'=>'unique:users',
//            'password'=>'required|min:8'
//        ]);
//        if($validator->fails()){
//            return BaseController::error($validator->errors()->first());
//        }
//        $data = User::create([
//            'name'=>$request->name,
//            'group_id'=>$request->group_id,
//            'phone'=>$request->phone,
//            'password'=>Hash::make($request->password),
//        ]);
//        return BaseController::success($data);
//    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'phone'=>'required',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return BaseController::error($validator->errors()->first());
        }
        if(Auth::attempt($request->only('phone','password'))){
            $token = Auth::user()->createToken('token')->plainTextToken;
            return BaseController::success(['token'=>$token]);
        }
    }

    public function getMe(){
        $user = Auth::user();
        return $user->id;
    }
}
