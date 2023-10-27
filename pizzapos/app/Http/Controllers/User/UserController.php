<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function clientpage() {
        return view('user.main.home');
    }
    //pw page
    public function pwpage() {
        return view('user.account.pwpage');
    }

    //real change password
    public function passwordChange(Request $req)
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

    }return redirect()->route('pw#page')->with(['notMatch' => 'The old password not match.Try again']);

}

   public function userdetail() {
    return view('user.account.userdetail');
   }

   //user edit page
   public function accedit() {
    return view('user.account.useredit');
   }


   public function accupdate($id,Request $request) {
    $this->accValidationCheck($request);
        $data = $this->getUserdata($request);
        //for image
        if ($request->hasFile('image')) {
            $dbimage = User::where('id', $id)->first();
            $dbimage = $dbimage->image;
            if ($dbimage != null) {
                Storage::delete(['public/', $dbimage]);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName); //db public save
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('client#page');
   }


   private function getUserdata($request)
   {
       return [
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
           'address' => $request->address,
           'gender' => $request->gender,
           'updated_at' => Carbon::now(),
       ];
   }


  //validation check adcheck
  private function accValidationCheck($request)
  {
      Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required',
          'phone' => 'required',
          'address' => 'required',
          'gender' => 'required',
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

