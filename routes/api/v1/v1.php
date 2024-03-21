<?php

use App\Http\Controllers\api\admin\CartController;
use App\Http\Controllers\api\admin\CategoryController;
use App\Http\Controllers\api\admin\ProductController;
use App\Http\Controllers\api\admin\ReviewController;
use App\Http\Controllers\api\admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
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
    Route::post('login', [AuthenticationController::class, 'login'])->middleware('guest:sanctum');

    Route::middleware('auth:sanctum')->group(function (){
       Route::post('logout', [AuthenticationController::class, 'logout']);
       Route::post('logout/all', [AuthenticationController::class, 'logoutFromAllDevices']);
       Route::prefix('admin')->middleware(['role:superadmin|admin|editor'])->group(function (){
//           Route::get('users/{user}/carts', [UserController::class, 'getUserCarts']);
           Route::apiResource('users', UserController::class);
           Route::apiResource('roles', RoleController::class);
           Route::apiResource('categories', CategoryController::class);
           Route::apiResource('products', ProductController::class);
           Route::apiResource('reviews', ReviewController::class);
//           Route::get('carts/{cart}/items', [CartController::class, 'getCartItems']);
           Route::apiResource('carts', CartController::class);

       });

//       Route::middleware('can:users-read')->get('meow', function (){
//           return 'yes';
//       });
    });

});

