<?php

namespace App\Http\Controllers;

use App\sub_administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserNavigationController extends Controller
{
    public function sub_administrator()
    {
        $all_sub_adminitrator = sub_administrator::paginate(20);
        return view('admin.subadministratror.index',compact('all_sub_adminitrator'));
    }

    public function sub_administrator_save(Request $request)
    {
        $create_sub_administrator = new sub_administrator();
        $create_sub_administrator->name = $request->name;
        $create_sub_administrator->user_name = $request->username;
        $create_sub_administrator->cradit = $request->cradit;
        $create_sub_administrator->password = Hash::make($request->password);
        $create_sub_administrator->save();
        return 'paisi';
    }
}
