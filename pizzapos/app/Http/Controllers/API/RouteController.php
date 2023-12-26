<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //
    public function apiuser() {
        $user = User::get();
        $order = Order::get();
        $data = [
            'users' => $user,
            'orders' => $order
        ];
        return response()->json($data, 200);

        // return response()->json([$order,$user], 200);

    }

    public function apiproduct() {
        $product = Product::get();
        $category = Category::get();
        $data = [
            'product' => $product,
            'category' => $category
        ];
        return response()->json($data, 200);
    }

    public function userproduct() {
        $user = User::get();
        $product = Product::get();
        $data = [
            'users' => $user,
            'product' => $product
        ];
        return response()->json($data, 200);
}







}
