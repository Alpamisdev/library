<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataValidateController extends Controller
{
    public function userValidator($data){
        $rules = [
            'name'=>'required',
            'group_id'=>'required',
            'phone'=>'required|unique:users',
            'password'=>'required|min:8'
        ];
        return $this->validate($data,$rules);
    }
}
