<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.order.orderlist', compact('order'));
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


    //what is ordercode
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

    //userorder single
    // public function addcart(Request $req) {
    //     logger($req->all());
    //     $data = [
    //         'user_id' => $req->userid,
    //         'product_id' => $req->pizzaid,
    //         'qty' => $req->count

    //     ];

    //     Cart::create($data);
    //     $response =   [
    //         'message' => 'Add to Cart complete',
    //         'status' => 'success'
    //     ];
    //     return response()->json($response,200);
    // }
    public function ordercart($id) {
        $data = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $id * 1,
                    'qty' => 1

                ];
                Cart::create($data);
                return back()->with(['createSuccess' => 'Order Created....']);
    }

}
