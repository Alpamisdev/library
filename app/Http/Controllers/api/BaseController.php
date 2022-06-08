<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public static function success($payload = [],$message = 'success', $code = 200){
        return response([
            'message'=>$message,
            'payload'=>$payload
        ],$code);
    }

    public static function error($payload = [],$message = 'error', $code = 419){
        return response([
            'message'=>$message,
            'payload'=>$payload
        ],$code);
    }
}
