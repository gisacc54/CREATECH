<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::prefix('/admin')->name('admin.')->middleware('admin')->group(function (){
        //Dashboard
        Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'showAdminDashboard'])->name('dashboard');

        //User management
        Route::prefix('users')->name('users.')->group(function (){
            Route::get('/',[\App\Http\Controllers\Admin\UserManagementController::class,'showUserManagementPanel'])->name('management');
            Route::get('/create',[\App\Http\Controllers\Admin\UserManagementController::class,'showCreateUserAccountPanel'])->name('create');
            Route::post('/create',[\App\Http\Controllers\Admin\UserManagementController::class,'createUserAccount'])->name('create');
            Route::get('/{id}/update',[\App\Http\Controllers\Admin\UserManagementController::class,'showUpdateUserAccountPanel'])->name('update');
            Route::post('/{id}/update',[\App\Http\Controllers\Admin\UserManagementController::class,'updateUserAccount'])->name('update');
        });

        //Account
        Route::prefix('account')->name('account.')->group(function (){
            Route::get('/',[\App\Http\Controllers\Admin\AccountController::class,'showMyAccountPanel'])->name('my-account');
            Route::get('/{id}',[\App\Http\Controllers\Admin\AccountController::class,'showAccountPanel'])->name('profile');
            Route::post('/{id}/change/password',[\App\Http\Controllers\Admin\AccountController::class,'changeAccountPassword'])->name('change.password');
            Route::post('/{id}/change/profile/image',[\App\Http\Controllers\Admin\AccountController::class,'changeAccountProfileImage'])->name('change.profile.image');

            Route::post('/{id}/balance',[\App\Http\Controllers\Admin\AccountController::class,'addBalance'])->name('balance');
        });
    });


    //Manager
    Route::prefix('/manager')->name('manager.')->middleware('manager')->group(function (){
        //Dashboard
        Route::get('/',[\App\Http\Controllers\Manager\HomeController::class,'showManagerDashboard'])->name('dashboard');

        //Account
        Route::prefix('account')->name('account.')->group(function (){
            Route::get('/',[\App\Http\Controllers\Manager\AccountController::class,'showMyAccountPanel'])->name('my-account');
            Route::post('/{id}/change/password',[\App\Http\Controllers\Manager\AccountController::class,'changeAccountPassword'])->name('change.password');
        });
    });

    //Staff
    Route::prefix('/')->name('staff.')->middleware('staff')->group(function (){
        //Dashboard
        Route::get('/',[\App\Http\Controllers\Staff\HomeController::class,'showStaffDashboard'])->name('dashboard');
        Route::post('/buy',[\App\Http\Controllers\Staff\HomeController::class,'buyAirTime'])->name('buy');
        Route::get('/transaction',[\App\Http\Controllers\Staff\HomeController::class,'transaction'])->name('transaction');
        //Account
        Route::prefix('account')->name('account.')->group(function (){
            Route::get('/',[\App\Http\Controllers\Staff\AccountController::class,'showMyAccountPanel'])->name('my-account');
            Route::post('/{id}/change/password',[\App\Http\Controllers\Staff\AccountController::class,'changeAccountPassword'])->name('change.password');

            Route::post('/credit-card',[\App\Http\Controllers\Staff\AccountController::class,'addCreditCard'])->name('credit-card');
        });
    });
});
