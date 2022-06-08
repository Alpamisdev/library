<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Ganer;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{

    public function search_book(Request $request){

        $data = Book::select('books.id', 'books.name as book_name', 'ganers.name as ganer_name', 'authors.name as author_name', 'books.count')
            ->join('ganers', 'books.ganer_id','ganers.id')
            ->join('authors', 'books.author_id', 'authors.id')
            ->where('books.name', 'LIKE', "%{$request->book}%")
            ->get();

        if($data == null){
            return BaseController::error([],'error',404);
        }

        return BaseController::success($data);

    }

    public function search_ganer(Request $request){
        $data = Ganer::where('ganers.name', 'LIKE', "%{$request->ganer}%")
        ->get();
        return BaseController::success($data);

        if($data == null){
            return BaseController::error([],'error',404);
        }
    }

    public function search_author(Request $request){
        $data = Author::where('authors.name', 'LIKE', "%{$request->author}%")
            ->get();
        return BaseController::success($data);

        if($data == null){
            return BaseController::error([],'error',404);
        }
    }



    public function search_faculty(Request $request){
        $data = Faculty::where('faculties.name', 'LIKE', "%{$request->faculty}%")
            ->get();
        return BaseController::success($data);

        if($data == null){
            return BaseController::error([],'error',404);
        }
    }

    public function search_group(Request $request){
        $user_id = Auth::user()->id;
        if( $user_id < 3){
            $data = Group::where('groups.name', 'LIKE', "%{$request->group}%")
                ->where('faculty_id',$request->faculty_id)
                ->get();
            return BaseController::success($data);

            if($data == null){
                return BaseController::error([],'error',404);
            }
        }else{
            return BaseController::error([],'error',401);
        }
    }

    public function search_student(Request $request){

        $data = User::where('is_student',1)
            ->where('users.name', 'LIKE', "%{$request->student}%")
            ->where('group_id',$request->group_id)
            ->get();
        return BaseController::success($data);

    }
}
