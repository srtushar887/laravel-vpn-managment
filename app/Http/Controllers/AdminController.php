<?php

namespace App\Http\Controllers;

use App\Reseller;
use App\sub_administrator;
use App\Subreseller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $sub_adm = sub_administrator::count();
        $reseller = Reseller::count();
        $sub_reseller = Subreseller::count();
        return view('admin.index',compact('sub_adm','reseller','sub_reseller'));
    }
}
