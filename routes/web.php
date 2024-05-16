<?php

use App\Http\Controllers\admin\AdminDashBoardController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'account'],function(){

    Route::group(['middleware'=>'guest'],function(){
        Route::get('login',[LoginController::class,'index'])->name('account.login');
        Route::get('register',[RegisterController::class, 'index'])->name('account.register');
        Route::post('registerProcess',[RegisterController::class, 'registerProcess'])->name('account.registerProcess');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard',[DashboardController::class,'index'])->name('account.dashboard');
    });
});







Route::get('admin/login',[AdminLoginController::class ,'index'])->name('admin.login');
Route::get('admin/logout',[AdminLoginController::class ,'logout'])->name('admin.logout');
Route::get('admin/dashboard',[AdminDashBoardController::class ,'index'])->name('admin.dashboard');
Route::post('admin/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');













