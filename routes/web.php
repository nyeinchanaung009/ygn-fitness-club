<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Membership\MembershipController;
use App\Http\Controllers\Monthlyfitnessdata\MonthlyfitnessController;
use App\Http\Controllers\Plan\PlanController;
use Illuminate\Support\Facades\Route;

// Admin Authentication
Route::get('/login',[AuthController::class,'loginview'])->name('loginview');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::group(['middleware' => 'adminAuth'],function(){
    // home
    Route::get('/',[AdminController::class,'home'])->name('home');

    //Branch
    Route::resource('branch',BranchController::class);

    //Plan
    Route::resource('plan',PlanController::class);

    //admin
    Route::resource('admin',AdminController::class);

    //member
    Route::resource('member',MemberController::class);

    //membership
    Route::resource('membership',MembershipController::class);
    Route::get('/membership/extendform/{id}',[MembershipController::class,'extendform'])->name('membership.extendform');
    Route::post('/membership/extendplan/{id}',[MembershipController::class,'extendPlan'])->name('membership.extendplan');

    //monthly fitness data
    Route::resource('monthlyfitnessdata',MonthlyfitnessController::class);

    // Admin logout
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});