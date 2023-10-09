<?php

use App\Http\Controllers\AdminController;
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
        Route::get('createpage', [CategoryController::class, 'categorycreatepage'])->name('category#createpage');
        Route::post('create', [CategoryController::class, 'categorycreate'])->name('category#create');
        Route::get('delete/{id}', [CategoryController::class, 'categorydelete'])->name('category#delete');
        Route::get('editpage/{id}', [CategoryController::class, 'categoryeditpage'])->name('category#editpage');
        Route::post('update', [CategoryController::class, 'categoryupdate'])->name('category#update');

    });

    Route::middleware(['admin_auth'])->group(function () {
        Route::prefix('admin')->group(function () {
            //password changepage
            Route::get('pwchangepage', [AdminController::class, 'changepwpage'])->name('changepw#page');
            //password change
            Route::post('passwordchange',[AdminController::class,'changepassword'])->name('change#password');
            //acc details
            Route::get('accdetail',[AdminController::class,'accdetail'])->name('acc#detail');
            //accedit page
            Route::get('acceditpage',[AdminController::class,'acceditpage'])->name('acc#editpage');
        });

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


//below route is testing
// Route::get('testedit',function() {
//     return view('admin.accouts.accedit');
// });
