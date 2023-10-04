<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //listpage
    public function categorylist() {
        $categories = Category::get();
        return view('admin.category.list',compact('categories'));
    }

    //showcreatepage
    public function categorycreatepage() {
        return view('admin.category.create');
    }

    //create only
    public function categorycreate(Request $req) {
      $this->categoryValidationCheck($req);
      $data = $this->requestCategoryData($req);
      Category::create($data);
      return redirect()->route('category#list')->with(['createSuccess' => 'Category Created....']);
    }

    //delete
    public function categorydelete($id) {
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Category delete....']);
   }







    //category validation check
private function categoryValidationCheck($request) {
    Validator::make($request->all(),[
        'categoryName' =>'required|min:5|unique:categories,name,'.$request->categoryId
    ])->validate();
}
//request category data
 private function requestCategoryData($request) {
     return [
        'name' =>$request->categoryName
     ];

 }
}
