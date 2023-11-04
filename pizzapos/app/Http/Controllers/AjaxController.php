<?php

namespace App\Http\Controllers;

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
}
