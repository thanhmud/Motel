<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
    return view('login');
});

Route::post("/execute-login", [AdminController::class, 'execute_login'])->name("execute.login");
Route::get("/logout", [AdminController::class, 'logout'])->name("logout");
Route::get("/register", [AdminController::class, 'register'])->name("register");
Route::post("/execute-register", [AdminController::class, 'execute_register'])->name("execute.register");

Route::group(['middleware' => [\App\Http\Middleware\CheckAdminLogin::class]], function () {
    Route::get("index", function () {
        return view("admin.dashboard");
    })->name("admin.index");

    Route::prefix('customer')->group(function () {
        Route::name("customer.")->group(function () {
            Route::get('view', [\App\Http\Controllers\CustomerController::class, 'getAllCustomer'])->name("view");
            Route::post('save', [\App\Http\Controllers\CustomerController::class, 'saveCustomer'])->name("save");
            Route::post('update', [\App\Http\Controllers\CustomerController::class, 'UpdateCustomer'])->name("update");
            Route::get('delete/{id}', [\App\Http\Controllers\CustomerController::class, 'DeleteCustomer'])->name("delete");
            //đổ dữ liệu phòng ra select2
            Route::get('get-room', [\App\Http\Controllers\CustomerController::class, 'getRoom'])->name("get.room.for.customer");
            Route::get('get-id-customer', [\App\Http\Controllers\CustomerController::class, 'getIDCustomer'])->name("get.id.customer");
        });
    });

    Route::prefix('service')->group(function () {
        Route::name("service.")->group(function () {
            Route::get('view', [\App\Http\Controllers\ServiceController::class, 'getAllService'])->name("view");
            Route::get('add', [\App\Http\Controllers\ServiceController::class, 'addService'])->name("add.service");
            Route::post('save', [\App\Http\Controllers\ServiceController::class, 'saveService'])->name("save.service");
            Route::get('edit/{id}', [\App\Http\Controllers\ServiceController::class, 'getEditService'])->name("edit");
            Route::post('update/{id}', [\App\Http\Controllers\ServiceController::class, 'UpdateService'])->name("update");
            Route::get('delete/{id}', [\App\Http\Controllers\ServiceController::class, 'DeleteService'])->name("delete");
        });
    });

    Route::prefix('room')->group(function () {
        Route::name("room.")->group(function () {
            Route::get('view', [\App\Http\Controllers\RoomController::class, 'getAllRoom'])->name("view");
            Route::get('add', [\App\Http\Controllers\RoomController::class, 'addRoom'])->name("add.room");
            Route::post('save', [\App\Http\Controllers\RoomController::class, 'saveRoom'])->name("save.room");
            Route::get('edit/{id}', [\App\Http\Controllers\RoomController::class, 'getEditRoom'])->name("edit");
            Route::post('update/{id}', [\App\Http\Controllers\RoomController::class, 'UpdateRoom'])->name("update");
            Route::get('delete/{id}', [\App\Http\Controllers\RoomController::class, 'DeleteRoom'])->name("delete");
        });
    });
});