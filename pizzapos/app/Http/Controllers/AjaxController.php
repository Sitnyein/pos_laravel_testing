<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //return piza list
    public function javascriptcase(Request $req) {
        
        $product = Product::get();
        return $product;
    }
}
