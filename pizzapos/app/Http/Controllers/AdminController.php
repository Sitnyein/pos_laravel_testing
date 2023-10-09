<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
