<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
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


}
