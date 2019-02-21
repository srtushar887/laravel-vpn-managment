<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientNavigationController extends Controller
{
    public function sub_reseller()
    {
        return view('admin.clientnavigation.create-vpn');
    }
}
