<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResellerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:reseller',['except'=>['logout']]);
    }

    public function showloginfrom()
    {
        return view('auth.reseller-login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'user_name' => 'required',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('reseller')->attempt(['user_name'=>$request->user_name,'password'=> $request->password ],$request->remember)){
            return redirect(route('reseller.dashboard'));
        }



        return redirect()->back()->with('errorlogin','User Name Or Password was Invalid');
    }

    public function logout()
    {
        Auth::guard('reseller')->logout();
        return redirect(url('/'));
    }
}
