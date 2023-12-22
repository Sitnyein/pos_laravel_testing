<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;

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
    return redirect()->route('auth#loginPage');
})->name('short#cut');


//login register for admin
Route::middleware(['admin_auth'])->group(function () {


    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    /*log in log out error */
    // 'auth:sanctum',
    // config('jetstream.auth_session'),
    // 'verified',
    'auth',
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
            Route::post('passwordchange', [AdminController::class, 'changepassword'])->name('change#password');
            //acc details
            Route::get('accdetail', [AdminController::class, 'accdetail'])->name('acc#detail');
            //accedit page
            Route::get('acceditpage', [AdminController::class, 'acceditpage'])->name('acc#editpage');
            //accupdate
            Route::post('accupdate/{id}', [AdminController::class, 'accupdate'])->name('acc#update');
            //admin list
            Route::get('list',[AdminController::class,'adminlist'])->name('admin#list');
            //account delete from admin list
            Route::get('delete/{id}',[AdminController::class,'accdelete'])->name('acc#delete');
            //admin want to change role from adminlist
            Route::get('changerole/{id}',[AdminController::class,'changerole'])->name('change#role');
            //admin want to see userlist
            Route::get('wantuser/list',[AdminController::class,'userlist'])->name('adminwant#userlist');
            //want to see customer order list
            Route::get('orderlist',[OrderController::class,'adminOrderlist'])->name('admin#orderlist');
            // admin want to see order collection of pending,success,reject
            Route::get('collection/orderlist',[OrderController::class,'collectorder'])->name('collect#order');
            //admin want to change order status
            Route::get('change/orderstatus',[OrderController::class,'changestatus'])->name('change#orderstatus');
        });
        /* for products*/
        Route::prefix('product')->group(function () {
           Route::get('list',[ProductController::class,'productlist'])->name('product#list');
           //createpiza page
           Route::get('page',[ProductController::class,'pizzapage'])->name('pizza#page');
           //only create piza
           Route::post('create',[ProductController::class,'pizzacreate'])->name('pizza#create');
           //delete pizza
           Route::get('delete/{id}',[ProductController::class,'pizadelete'])->name('pizza#delete');
           //showing more detail
           Route::get('moredetail/{id}',[ProductController::class,'moreinfo'])->name('pizza#detail');
           //edit page
           Route::get('edit/{id}',[ProductController::class,'edit'])->name('pizza#edit');
           Route::post('update/{id}',[ProductController::class,'update'])->name('pizza#update');

        });

    });

//user
    Route::group(['prefix' => 'user', 'middleware' => "user_auth"], function () {

        // Route::view('clientpage', 'user.main.home')->name('client#page');
        Route::get('clientpage',[UserController::class,'clientpage'])->name('client#page');
        //filter by category
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('pwpage',[UserController::class,'pwpage'])->name('pw#page');
        //real pwchage
        Route::post('pwchange',[UserController::class,'passwordChange'])->name('pw#change');
        //detial user account
        Route::get('userdetail',[UserController::class,'userdetail'])->name('user#detail');
        //edit user account
        Route::get('accedit',[UserController::class,'accedit'])->name('user#edit');
        //update user account
        Route::post('update/account/{id}',[UserController::class,'accupdate'])->name('user#update');

        // this is pizza detail
        Route::get('pizza/detail/{id}',[UserController::class,'pizadetail'])->name('piza#detail');
        //this is user cartlist
        Route::get('cartlist',[UserController::class,'cartlist'])->name('cart#list');
        //orderhistroy
        Route::get('order/history',[UserController::class,'orderhistory'])->name('order#history');

        //this is ajax
        Route::get('ajax',[AjaxController::class,'javascriptcase'])->name('user#ajax');
        //cartlist show
        Route::get('ajax/cart',[AjaxController::class,'addcart'])->name('add#cart');
        //order
        Route::get('ajax/order',[AjaxController::class,'order'])->name('ajax#order');
        //single cart remove
        Route::get('ajax/singlecart',[AjaxController::class,'singlecart'])->name('single#cart');
        //cannel cartlist and all delete cartlist
        Route::get('ajax/clearcart',[AjaxController::class,'clearcart'])->name('clear#cart');



    });



























});

//

// Route::get('/', function () {
//     return redirect()->route('auth#loginPage');
// });
// Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
// Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

Route::view('URI', 'viewName');

//below route is testing
// Route::get('testedit',function() {
//     return view('admin.accouts.accedit');
// });

Route::get('testing',function() {
    return view('user.main.detail');
});
