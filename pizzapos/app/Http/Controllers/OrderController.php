<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    ////admin want to see customer orderlist

    public function adminOrderlist()
    {
        $order = Order::Select('orders.*', 'users.name as username', 'users.id as userid')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->get();

        return view('admin.order.orderlist', compact('order'));
    }

    //admin want to see collection of pending success reject
    public function collectorder(Request $req)
    {
        $order = Order::Select('orders.*', 'users.name as username', 'users.id as userid')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id');

        if ($req->status == null) {$order = $order->get();} else {
            $order = $order->where('orders.status', $req->status)->get();
        }
        return response()->json($order, 200);
    }
}
