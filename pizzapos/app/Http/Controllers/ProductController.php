<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productlist() {
        return view('admin.products.plist');
    }
}
