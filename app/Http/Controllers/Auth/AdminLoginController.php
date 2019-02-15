<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin',['except'=>['logout']]);
    }

    public function showloginfrom()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'user_name' => 'required',
            'password' => 'required|min:6'
        ]);
        if(Auth::guard('admin')->attempt(['user_name'=>$request->user_name,'password'=>$request->password],$request->remember)){
            return redirect(route('admin.dashboard'));
        }

        return redirect()->back()->with('errorlogin','User Name Or Password was Invalid');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
