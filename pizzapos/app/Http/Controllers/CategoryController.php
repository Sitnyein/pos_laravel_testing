<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function categorylist() {
        return view('admin.category.list');
    }
}
