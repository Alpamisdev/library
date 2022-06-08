<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::select('books.id', 'books.name as book_name', 'ganers.name as ganer_name', 'authors.name as author_name', 'books.count')
            ->join('ganers', 'books.ganer_id','ganers.id')
            ->join('authors', 'books.author_id', 'authors.id')
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
            'ganer_id'=>'required',
            'author_id'=>'required',
            'count'=>'required'
        ]);
        if($validator->fails()){
            return BaseController::error($validator->errors()->first());
        }
        $data = Book::create([
            'name'=>$request->name,
            'ganer_id'=>$request->ganer_id,
            'author_id'=>$request->author_id,
            'count'=>$request->count
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
    public function destroy($id)
    {
        //
    }
}
