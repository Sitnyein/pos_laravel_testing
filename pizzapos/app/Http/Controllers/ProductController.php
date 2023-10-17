<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productlist() {
        return view('admin.products.plist');
    }

    //create page
    public function pizzapage() {
        $categories = Category::select('id','name')->get();
        return view('admin.products.pcreate',compact('categories'));
    }

    //only create
    public function pizzacreate(Request $req) {
       $this->pizzaValidationCheck($req);
       $data = $this->createproduct($req);
       $fileName= uniqid() . $req->file('image')->getClientOriginalName();
       $req->file('image')->storeAs('public',$fileName); //db public save
       $data['image'] = $fileName;
       Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess' => 'Product Created....']);

    }


    //createpizza
    private function createproduct($request) {
        return[
          'name' => $request->name,
          'category_id' => $request->categoryId,
          'description' =>$request->description,
          'price' =>$request->price,
          'waiting_time' =>$request->time,
          'created_at' =>Carbon::now()
        ];
    }
 //validation check adcheck
 private function pizzaValidationCheck($request) {
    Validator::make($request->all(),[
     'name' => 'required|min:5|unique:products,name,',
     'categoryId' => 'required',
     'time' => 'required',
     'description' => 'required|min:5',
     'price' => 'required',
     'image' => 'required|mimes:jpg,bmp.png|file'
   ])->validate();


}




}


/*validation  other

$validation = [
    'postTitle' => 'required|min:5|unique:customers,title,' . $request->postId,
    'PostD' => 'required|min:4,',
    'postimage' => 'mimes:jpg,bmp.png|file',
    // 'postFee'=>'required',
    // 'postAddress'=>'required',
    // 'postrate'=>'required',

];
$validationmessage = [
    'postTitle.required' => 'You need to fill Post title',
    'postTitle.min' => 'you must be write more than five letters ',
    'postTitle.unique' => 'Title is already taken,Try another name',
    'PostD.required' => 'You need to fill Post description',
    // 'postFee.required'=>'You need to write fee',
    // 'postAddress.required'=>'location access is need',
    // 'postrate.required'=>'Plz give me comment',
    'postimage.mimes' => 'it must be image only accept',

];

Validator::make($request->all(), $validation, $validationmessage)->validate();

*/
