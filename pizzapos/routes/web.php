<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'whois'])->name('dashboard');
//admin
//category
    Route::group(['prefix' => 'category', 'middleware' => "admin_auth"], function () {

        Route::get('list', [CategoryController::class, 'categorylist'])->name('category#list');
        Route::get('createpage',[CategoryController::class,'categorycreatepage'])->name('category#createpage');
        Route::post('create',[CategoryController::class,'categorycreate'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'categorydelete'])->name('category#delete');
        Route::get('editpage/{id}',[CategoryController::class,'categoryeditpage'])->name('category#editpage');
        Route::post('update',[CategoryController::class,'categoryupdate'])->name('category#update');


    });

//user
    Route::group(['prefix' => 'user', 'middleware' => "user_auth"], function () {

        Route::view('clientpage', 'user.home')->name('client#page');
    });

});

//
Route::get('/', function () {
    return redirect()->route('auth#loginPage');
});
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

Route::view('URI', 'viewName');



Route::get('template',function() {
    return view('admin.template.template');
});
Route::get('test/category',function() {
    return view('admin.category.create');
});
