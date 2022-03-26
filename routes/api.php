<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\V1\{LoginController,LogoutController,UserController,SellerController,ShipperController
,DashbaordController,ProvincesController,UserChangePassword,VehicleController,SignController,SellerChangePassword
,TypeController,UserOrderController};


Route::middleware(['throttle:login'])->group(function (){
    Route::post('login',LoginController::class);
});


Route::middleware('auth:sanctum')->group(function (){


    // admin handle
    Route::prefix('admin')->group(function (){
        Route::get('logout',LogoutController::class);
    });

    Route::prefix('company')->group(function (){
        Route::get('data',DashbaordController::class);
    });

    //user
    Route::controller(UserController::class)->prefix('users')->group(function (){
            Route::put('restore/{id}','restore')->whereNumber('id');
            Route::put('update-commercial-info/{id}','updateCommercialInfo')->whereNumber('id');
    });

    Route::prefix('users')->group(function (){
        Route::put('change-password/{id}',UserChangePassword::class)->whereNumber('id');
        Route::prefix('vehicles')->group(function (){
            Route::get('/{user_id}',[VehicleController::class,'vehiclesByUser'])->whereNumber('user_id');
        });
        Route::prefix('orders')->group(function (){
            Route::get('/{user_id}',[UserController::class,'fetchOrderByUser'])->whereNumber('user_id');
        });
    });

    // signs

    Route::controller(SignController::class)->prefix('signs')->group(function (){
        Route::get('all','signs');
        Route::put('restore/{id}','restore')->whereNumber('id');
        Route::post('change-sign-logo','changeLogoSign');
    });

    // sellers

    Route::prefix('sellers')->group(function (){
        Route::put('change-password/{id}',SellerChangePassword::class)->whereNumber('id');
    });

    Route::controller(SellerController::class)->prefix('sellers')->group(function (){
        Route::put('restore/{id}','restore')->whereNumber('id');
        Route::get('phones/{id}','sellerPhones')->whereNumber('id');
        Route::get('jobs/{id}','sellerJobs')->whereNumber('id');

        Route::prefix('phones')->group(function (){
            Route::post('store','storeSellerPhones')->whereNumber('id'); // refactor
            Route::put('update/{id}','updateSellerPhone')->whereNumber('id');
            Route::delete('destroy/{id}','destroySellerPhone')->whereNumber('id');
        });

        Route::prefix('jobs')->group(function (){
            Route::post('store','storeSellerJob');
            Route::delete('destroy/{id}','destorySellerJob')->whereNumber('id');
        });
    });

    //types

    Route::controller(TypeController::class)->prefix('types')->group(function (){
        Route::get('all','types');
        Route::post('excel-import-types','storeTypesExcel');
        Route::put('restore/{id}','restore')->whereNumber('id');
    });

    //shippers

    Route::controller(ShipperController::class)->prefix('shippers')->group(function (){
        Route::put('restore/{id}','restore')->whereNumber('id');
        Route::get('comissions/{id}','shipperComissions')->whereNumber('id');
    });

    // proviences

    Route::controller(ProvincesController::class)->prefix('provinces')->group(function (){
        Route::get('all','all');
        Route::post('excel-import-provinces','storeProvincesExcel');
        Route::get('activate/{province_id}','activeProvince')->whereNumber('province_id');
        Route::get('deactivate/{province_id}','deactivateProvince')->whereNumber('province_id');
    });

    // user orders

    Route::controller(UserOrderController::class)->prefix('orders')->group(function (){
        Route::get('all','getAllOrders');
        Route::get('items/{user_order_id}','getOrderItemsByUser')->whereNumber('user_order_id');
        Route::get('events/{user_order_id}','getOrderEventsByUser')->whereNumber('user_order_id');
    });

    //resources
    Route::apiResources([
        'users' => UserController::class,
        'sellers' => SellerController::class,
        'shippers' => ShipperController::class,
        'provinces' => ProvincesController::class,
        'vehicles' =>  VehicleController::class,
        'signs' => SignController::class,
        'types' => TypeController::class
    ]);

});
