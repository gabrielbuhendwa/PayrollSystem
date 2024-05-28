<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(){
      
        return view('admin.login');
    }

    public function doLogin(LoginAdminRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('admin.index'));
        }

        return back()->withErrors([
            'password' => 'Incorrect email or password. please try again.'
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'you have successfully logged out.');
    }
}
