<?php

namespace App\Http\Controllers\Auth;

use App\sub_administrator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdministratorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:administrator',['except'=>['logout']]);
    }

    public function showloginfrom()
    {
        return view('auth.administrator-login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'user_name' => 'required',
            'password' => 'required|min:6'
        ]);

            if(Auth::guard('administrator')->attempt(['user_name'=>$request->user_name,'password'=> $request->password ],$request->remember)){
                return redirect(route('administrator.dashboard'));
            }



        return redirect()->back()->with('errorlogin','User Name Or Password was Invalid');
    }

    public function logout()
    {
        Auth::guard('administrator')->logout();
        return redirect(route('admin.login'));
    }
}
