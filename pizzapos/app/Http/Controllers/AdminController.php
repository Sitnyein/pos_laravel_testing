<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function changepwpage()
    {
        return view('admin.accouts.changepw');
    }
    /*
    {
    $data=[
    'password' => Hash::make($request->newPassword)
    ];
    User::where('id',Auth::user()->id)->update($data);
    //   Auth::logout();
    //   return redirect()->route('auth#loginPage');
    return back()->with(['success' => 'password change sucess']);

    } return back()->with(['notMatch' => 'The old password not match.Try again!']);
     */
    //password change
    public function changepassword(Request $req)
    {
        $this->passwordValidationCheck($req);
        $user = User::where('id', Auth::user()->id)->first();
        $dbpassword = $user->password;
        if (Hash::check($req->oldPassword, $dbpassword)) {
            $data = [
                'password' => Hash::make($req->newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);
            return back()->with(['success' => 'password change sucess']);

        }return redirect()->route('changepw#page')->with(['notMatch' => 'The old password not match.Try again!']);

    }

    //acc detail
    public function accdetail() {
        return view('admin.accouts.details');
    }
    //acc edit page
    public function acceditpage() {
        return view('admin.accouts.accedit');
    }

    //admin update/edit acc
public function accupdate($id,Request $request) {

    $this->accValidationCheck($request);
    $data = $this->getUserdata($request);
   //for image
   if($request->hasFile('image')) {
     $dbimage = User::where('id',$id)->first();
     $dbimage= $dbimage->image;
     if($dbimage != null) {
       Storage::delete(['public/',$dbimage]);
     }
   $fileName= uniqid() . $request->file('image')->getClientOriginalName();
   $request->file('image')->storeAs('public',$fileName); //db public save
   $data['image'] = $fileName;
   }


    User::where('id',$id)->update($data);
    return redirect()->route('acc#detail');
   }


   //admin list
   public function adminlist() {
    $user = User::where('role','admin')->get();

    $admin = User::when(request('key'),function($query) {
        $query->Where('name','like','%'.request('key').'%');

        // ->Where('address','like','%'.request('key').'%');
    })->where('role','admin')->paginate(3);


    // $admin->appends(request()->all());

     return view('admin.accouts.adminlist',compact('admin'));
   }


   //admin delete account
   public function accdelete($id) {
    {   $dbimage = User::where('id', $id)->first();
        $dbimage = $dbimage->image;
        if($dbimage !== null) {
            Storage::delete(['public/', $dbimage]);

        }

        $product = User::where('id', $id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess' => 'You have  removed  account ....']);

    }

   }

   //admin change role
   public function changerole($id) {
    $user = User::where('id',$id)->first();


     User::where('id',$id)->update([
        'role' => 'user' ]);
        return redirect()->route('admin#list')->with(['deleteSuccess' => 'You have  change role   account ....']);


   }
//    admin want to see useliist
   public function userlist() {
    $user = User::when(request('key'),function($query) {
        $query->Where('name','like','%'.request('key').'%');
        // ->orWhere('address','like','%'.request('key').'%');
    })->where('role','user')->paginate(3);
    $user->appends(request()->all());
     return view('admin.accouts.userlist',compact('user'));
   }


   //get user data for adedit
   private function getUserdata($request) {
       return[
         'name' => $request->name,
         'email' => $request->email,
         'phone' =>$request->phone,
         'address' =>$request->address,
         'gender' =>$request->gender,
         'updated_at' =>Carbon::now()
       ];
   }

   //validation check adcheck
   private function accValidationCheck($request) {
          Validator::make($request->all(),[
           'name' => 'required',
           'email' => 'required',
           'phone' => 'required',
           'address' => 'required',
           'gender' => 'required'
         ])->validate();

   }
    //for change password//
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:5',
            'newPassword' => 'required|min:5',
            'comfrimPassword' => 'required|min:5|same:newPassword',
        ])->validate();

    }
}
