<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Group::select('groups.id', 'groups.name as group_name', 'faculties.name as faculty_name')
            ->join('faculties', 'groups.faculty_id', 'faculties.id')
            ->get();
        return BaseController::success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'faculty_id'=>'required'
        ]);
        if($validator->fails()){
            return BaseController::error($validator->errors()->first());
        }
        $data = Group::create([
            'name'=>$request->name,
            'faculty_id'=>$request->faculty_id
        ]);
        return BaseController::success($data);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Group::destroy($id);
        return BaseController::success();
    }
}
