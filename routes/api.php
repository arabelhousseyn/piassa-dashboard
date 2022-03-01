<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\V1\{LoginController,LogoutController,UserController,SellerController,ShipperController};

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

Route::middleware(['throttle:login'])->group(function (){
    Route::post('login',LoginController::class);
});


Route::middleware('auth:sanctum')->group(function (){


    // admin handle
    Route::prefix('admin')->group(function (){
        Route::get('logout',LogoutController::class);
    });

    Route::apiResources([
        'user' => UserController::class,
        'seller' => SellerController::class,
        'shipper' => ShipperController::class
    ]);

});
