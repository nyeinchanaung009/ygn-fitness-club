<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginview(){
        if(Auth::check()){
            return redirect('/');
        }

        return  view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $remember = $request->has('remember');
        $cre = $request->only('email','password');

        if(Auth::attempt($cre,$remember)){
            return redirect('/');
        }else{
            return redirect()->route('loginview')->with('error','Login Fail!')->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('loginview');
    }
}
