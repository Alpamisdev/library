<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all();
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
            'user_id'=>'required|exists:App\Models\User,id',
            'book_id'=>'required|exists:App\Models\Book,id'
        ]);
        if($validator->fails()){
            return BaseController::error($validator->errors()->first());
        }

        $book_count = Book::where('id', $request->book_id)->pluck('count')[0]-1;
        Book::where('id',$request->book_id)->update([
            'count'=>$book_count
        ]);

        $data = Order::create([
            'user_id'=>$request->user_id,
            'book_id'=>$request->book_id
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
        $book_id = Order::where('id', $id)->pluck('book_id');
        $book_count = Book::where('id', $book_id)->pluck('count')[0]+1;
        Book::where('id',$book_id)->update([
            'count'=>$book_count
        ]);

        Order::destroy($id);
        return BaseController::success();

    }
}
