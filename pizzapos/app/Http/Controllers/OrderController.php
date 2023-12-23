<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderlist;
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
    //admin want to change order status
    public function changestatus(Request $req)
    {



        $status = [
            'status' =>$req->status
        ];
        $order = Order::where('id',$req->orderid)->update($status);
               $response =   [
                'message' => 'Add to order complete',
                'status' => 'success'
            ];
            return response()->json($response,200);
    }

    public function ordercode($ordercode)
    {

        $order = Orderlist::Select('orderlists.*','products.name as productname','products.image as product_image')

            ->leftJoin('products','products.id','orderlists.product_id')
            ->where('ordercode', $ordercode)->get();

        $orderprice = Order::Select('orders.*', 'users.name as username')
                     ->leftJoin('users', 'users.id', 'orders.user_id')
                      ->where('ordercode',$ordercode)->first();


             return view('admin.order.ordercode',compact('order','orderprice'));
    }

}
