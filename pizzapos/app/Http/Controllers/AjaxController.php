<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return piza list
    public function javascriptcase(Request $req) {

        // $product = Product::get();
        if($req->status == 'asc') {
            $data = Product::orderBy('created_at','asc')->get();
        }else if($req->status == 'desc') {
            $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }

    public function addcart(Request $req) {
        logger($req->all());
        $data = [
            'user_id' => $req->userid,
            'product_id' => $req->pizzaid,
            'qty' => $req->count

        ];

        Cart::create($data);
        $response =   [
            'message' => 'Add to Cart complete',
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    public function order(Request $req) {
        // logger($req->all());
        $total = 0;
       foreach($req->all() as $item) {
       $data =    Orderlist::create([
        'user_id' => $item['userid'],
        'product_id' => $item['productid'],
        'qty' => $item['qty'],
        'total' => $item['total'],
        'ordercode' => $item['ordercode']
        ]);
        $total += $data->total;
       }

       Cart::where('user_id',Auth::user()->id)->delete();

       Order::create([
        'user_id' => Auth::user()->id,
         'ordercode' => $data->ordercode,
         'total_price' => $total + 3000

       ]);

       $response =   [
        'message' => 'Add to order complete',
        'status' => 'success'
    ];
    return response()->json($response,200);
    }

//public function  cart remove single
public function singlecart(Request $req) {
  $data =  Cart::where('user_id',Auth::user()->id)
  ->where('id',$req->cartid)->delete();

}

//public function  cart remove all of cartlist
public function clearcart(Request $req) {
    $data =  Cart::where('user_id',Auth::user()->id)->delete();

    $response =   [
        'message' => 'Add to order complete',
        'status' => 'success'
    ];
    return response()->json($response,200);


   //need to testing
  }

  //increase view count
  public function viewcount(Request $req) {
    $product = Product::where('id',$req->productid)->first();

    $viewcount = [
        'view_count' => $product->view_count +1
    ];
    Product::where('id',$req->productid)->update($viewcount);

  }




















}//endline
