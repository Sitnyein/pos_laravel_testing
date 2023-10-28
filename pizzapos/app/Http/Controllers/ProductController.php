<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{ //read
    public function productlist()
    {
        $products = Product::select('products.*','categories.name as category_name')
        ->when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->leftJoin('categories','products.category_id','categories.id')
            ->orderBy('products.id', 'desc')->paginate(3);
            $products->appends(request()->all());
          ;

        return view('admin.products.plist', compact('products'));
    }

    //create page
    public function pizzapage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.products.pcreate', compact('categories'));
    }

    //only create
    public function pizzacreate(Request $req)
    {
        $this->pizzaValidationCheck($req,"create");
        $data = $this->createproduct($req);
        $fileName = uniqid() . $req->file('image')->getClientOriginalName();
        $req->file('image')->storeAs('public', $fileName); //db public save
        $data['image'] = $fileName;
        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess' => 'Product Created....']);

    }

    // detail product page
     public function moreinfo($id) {
        $item = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.pdetail',compact('item'));
     }



    //delete
    public function pizadelete($id)
    {   $dbimage = Product::where('id', $id)->first();
        $dbimage = $dbimage->image;
        Storage::delete(['public/', $dbimage]);
        //Storage::delete(['public/',$dbimage])

        $product = Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Delete in the menu list ....']);

    }

    //edit page
    public function edit($id) {
        $product = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.products.pedit',compact('product','category'));
    }

    //update pizza
    public function update($id,Request $req) {


        $this->pizzaValidationCheck($req,"update");
        $data = $this->createproduct($req);
        if ($req->hasFile('image')) {
            $dbimage = Product::where('id', $id)->first();
            $dbimage = $dbimage->image;
            if ($dbimage != null) {
                Storage::delete(['public/', $dbimage]);
            }
            $fileName = uniqid() . $req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public', $fileName); //db public save
            $data['image'] = $fileName;
        }

        Product::where('id', $id)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess' => 'Product update success....']);


    }
    //createpizza && update pizza
    private function createproduct($request)
    {
        return [
            'name' => $request->name,
            'category_id' => $request->categoryId,
            'description' => $request->description,
            'price' => $request->price,
            'waiting_time' => $request->time,
            'created_at' => Carbon::now(),
        ];
    }
    //validation check adcheck for create && update
    private function pizzaValidationCheck($request,$action)
    {
        $validationrules = [

                'name' => 'required|min:5|unique:products,name,'.$request->pizzaid,
                'categoryId' => 'required',
                'time' => 'required',
                'description' => 'required|min:5',
                'price' => 'required',

        ];
        $validationrules['image'] = $action == "create" ? 'required|mimes:jpg,bmp.png|file' : 'mimes:jpg,bmp.png|file' ;
        Validator::make($request->all(), $validationrules  )->validate();

    }

}


