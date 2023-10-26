<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

