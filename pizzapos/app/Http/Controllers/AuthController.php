<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginPage() {
        return view('login');
    }
    public function registerPage() {
        return view('register');
    }

    public function whois() {
        if(Auth::user()->role == "admin") {
            return redirect()->route('category#list');
        }
            return redirect()->route('client#page');
    }
}
