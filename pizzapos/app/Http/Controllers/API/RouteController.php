<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //
    public function apiuser() {
        $user = User::get();
        $order = Order::get();
        $data = [
            'users' => $user,
            'orders' => $order
        ];
        return response()->json($data, 200);

        // return response()->json([$order,$user], 200);

    }

    public function apiproduct() {
        $product = Product::get();
        $category = Category::get();
        $data = [
            'product' => $product,
            'category' => $category
        ];
        return response()->json($data, 200);
    }

    public function userproduct() {
        $user = User::get();
        $product = Product::get();
        $data = [
            'users' => $user,
            'product' => $product
        ];
        return response()->json($data, 200);
}

//create api contact
    public function apicontact(Request $req) {
       $data = [
        'name' => $req->name,
        'email' => $req->email,
        'message' => $req->message,
        'created_at' =>Carbon::now(),
        'updated_at' =>Carbon::now()

       ];
       Contact::create($data);

       $person = Contact::orderBy('id','desc')->get();

       return response()->json($person, 200);
    }

    public function delcontact(request $req) {
       $data = Contact::where('id',$req->contact_id)->first();
        //    dd(isset($data));
       if(isset($data)) {
         return response()->json(['message' => 'delete success','data' => $data], 200);


       }
    return response()->json(['message' => 'This id no found any data'], 200);

    }

    public function updatecontact(Request $req) {
        $olddata = Contact::where('id',$req->id)->first();
       if(isset($olddata)) {
        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'message' => $req->message,
            'updated_at' =>Carbon::now()

           ];
        Contact::where('id',$req->id)->update($data);
        $newdata =  Contact::where('id',$req->id)->first();

          return response()->json(['newdata' => $newdata,'olddata' => $olddata], 200);
       }

         return response()->json(['message' => 'you can not update data'], 200, );
        // return $data;
        // dd($req->all());
    }






}
// $data = [
//     'name' => $req->name,
//     'email' => $req->email,
//     'message' => $req->message,
//     'updated_at' =>Carbon::now()

//    ];
// return response()->json([$olddata], 200);
