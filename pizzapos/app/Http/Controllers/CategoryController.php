<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //listpage
        public function categorylist() {
            $categories =Category::when(request('key'),function($query){
             $query->where('name','like','%'.request('key') .'%');
            })
            ->orderBy('id','desc')->paginate(4);
               $categories->appends(request()->all());
          return view('admin.category.list',compact('categories'));
      }



    //showcreatepage
    public function categorycreatepage()
    {
        return view('admin.category.create');
    }

    //create only
    public function categorycreate(Request $req)
    {
        $this->categoryValidationCheck($req);
        $data = $this->requestCategoryData($req);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess' => 'Category Created....']);
    }

    //delete
    public function categorydelete($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess' => 'Category delete....']);
    }

    //edit page
    public function categoryeditpage($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    //really edit page
    public function categoryupdate(Request $request)

    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess' => 'Category successful updated ....']);

    }

    //category validation check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|min:5|unique:categories,name,' . $request->categoryId,
        ])->validate();
    }
//request category data
    private function requestCategoryData($request)
    {
        return [
            'name' => $request->categoryName,
        ];

    }
}
