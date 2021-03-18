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

Route::get('/', function () {return view('login');});

Route::post("/execute-login",[AdminController::class,'execute_login'])->name("execute.login");
Route::get("/logout",[AdminController::class,'logout'])->name("logout");
Route::get("/register",[AdminController::class,'register'])->name("register");
Route::post("/execute-register",[AdminController::class,'execute_register'])->name("execute.register");

Route::group(['middleware' => [\App\Http\Middleware\CheckAdminLogin::class]], function() {
    Route::get("index",function() {return view("admin.dashboard"); })->name("admin.index");

    Route::prefix('customer')->group(function () {
        Route::name("customer.")->group(function () {
            Route::get('view', [\App\Http\Controllers\CustomerController::class, 'getAllCustomer'])->name("view");
            Route::get('add', [\App\Http\Controllers\CustomerController::class, 'addCustomer'])->name("add.customer");
            Route::post('save', [\App\Http\Controllers\CustomerController::class, 'saveCustomer'])->name("save.customer");
            Route::get('edit/{id}', [\App\Http\Controllers\CustomerController::class, 'getEditUser'])->name("edit");
            Route::post('update/{id}', [\App\Http\Controllers\CustomerController::class, 'UpdateUser'])->name("update");
            Route::get('delete/{id}', [\App\Http\Controllers\CustomerController::class, 'DeleteUser'])->name("delete");
        });
    });
});
