<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('user/order',[RouteController::class,'apiuser']);
Route::get('category/product',[RouteController::class,'apiproduct']);
Route::get('user/product',[RouteController::class,'userproduct']);

Route::get('apitesting',function() {
    $data = [
        'message' => 'this is api testing'
    ];
     return response()->json($data, 200);
});
