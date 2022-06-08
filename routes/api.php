<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\GanerController;
use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\FacultyController;
use App\Http\Controllers\api\GroupController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\SearchController;
use App\Http\Controllers\api\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('users',UserController::class);
    Route::apiResource('ganers', GanerController::class);
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('faculties', FacultyController::class);
    Route::apiResource('groups', GroupController::class);
    Route::apiResource('orders', OrderController::class);

    Route::controller(SearchController::class)->group(function (){
        route::get('/searchbook', 'search_book');
        route::get('/searchganer', 'search_ganer');
        route::get('/searchauthor', 'search_author');
        route::get('/searchfaculty', 'search_faculty');
        route::get('/searchgroup', 'search_group');
        route::get('/searchstudent', 'search_student');
    });
});

Route::controller(LoginController::class)->group(function (){
    route::get('/login', 'login');
});
