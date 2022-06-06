<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\V1\{LoginController,LogoutController,UserController,SellerController,ShipperController
,DashbaordController,ProvincesController,UserChangePassword,VehicleController,SignController,SellerChangePassword
,TypeController,UserOrderController,NotificationController,StatisticsController,AdminController,
    AdminChangePasswordController,AdminChangeProfileController,AdController};


Route::middleware(['throttle:login','app_version'])->group(function (){
    Route::post('login',LoginController::class);
});

// except case no need for auth token

Route::controller(AdController::class)->prefix('ads')->group(function (){
    Route::get('resize/{width}/{height}','resize')->whereNumber(['width','height']);
});

Route::middleware(['auth:sanctum','app_version'])->group(function (){


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
            Route::post('send-push-notifications','sendPushNotification');
            Route::post('store-note','storeNote');
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

        Route::get('types/{seller_job}','getSellerJobTypes')->whereNumber('seller_job');
        Route::get('signs/{seller_job}','getSellerJobSigns')->whereNumber('seller_job');

        Route::post('store_types','storeSellerJobTypes');
        Route::post('store_signs','StoreSellerJobSigns');

        Route::delete('destroy_seller_type/{seller_job_type}','destorySellerType')->whereNumber('seller_job_type');
        Route::delete('destroy_seller_sign/{seller_job_sign}','destorySellerSign')->whereNumber('seller_job_type');

        Route::put('update_job_description/{seller_job}','updateDescriptionJob')->whereNumber('seller_job');

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
        //Route::post('excel-import-types','storeTypesExcel');
        Route::put('restore/{id}','restore')->whereNumber('id');
        Route::post('change-type-logo','changeLogoType');
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
        Route::delete('destroy/{user_order_id}','destroy')->whereNumber('user_order_id');
        Route::put('restore/{user_order_id}','restore')->whereNumber('user_order_id');
        Route::put('confirm-order/{user_order_id}','confirmOrder')->whereNumber('user_order_id');
    });

    // notifications

    Route::controller(NotificationController::class)->prefix('notifications')->group(function (){
        Route::put('read','read');
    });

    // statistics

    Route::controller(StatisticsController::class)->prefix('statistics')->group(function (){
        Route::get('request-expired/{days}','requestExpired')->whereNumber('days');
    });

    // admins

    Route::controller(AdminController::class)->prefix('admins')->group(function (){
        Route::put('restore/{id}','restore')->whereNumber('id');
        Route::put('change-password/{id}','changePassword')->whereNumber('id');
    });

    Route::prefix('admins')->group(function (){
        Route::put('update-password-admin-dashboard',AdminChangePasswordController::class);
        Route::put('update-profile-admin-dashboard',AdminChangeProfileController::class);
    });

    // ads


    //resources
    Route::apiResources([
        'admins' => AdminController::class,
        'users' => UserController::class,
        'sellers' => SellerController::class,
        'shippers' => ShipperController::class,
        'provinces' => ProvincesController::class,
        'vehicles' =>  VehicleController::class,
        'signs' => SignController::class,
        'types' => TypeController::class,
        'ads' => AdController::class
    ]);

});
