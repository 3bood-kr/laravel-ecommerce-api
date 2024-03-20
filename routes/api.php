<?php

use App\Http\Controllers\Api\Auth\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/')->group(function (){
   Route::get('meow', function (){
       return response([
           'hi' => 'test',
       ]);
   });
});

//Route::get('/meow', [AuthenticationController::class, 'login']);

