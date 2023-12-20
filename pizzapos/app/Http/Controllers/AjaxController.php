<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;

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
       foreach($req->all() as $item) {
        Orderlist::create([
        'user_id' => $item['userid'],
        'product_id' => $item['productid'],
        'qty' => $item['qty'],
        'total' => $item['total'],
        'ordercode' => $item['ordercode']
        ]);
       }
       $response =   [
        'message' => 'Add to order complete',
        'status' => 'success'
    ];
    return response()->json($response,200);
    }






















}//endline
