<?php

namespace App\Http\Controllers;

use App\Reseller;
use App\sub_administrator;
use App\Subreseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $create_sub_administrator->user_name = $request->user_name;
        $create_sub_administrator->cradit = $request->cradit;
        $create_sub_administrator->password = encrypt($request->password);
        $create_sub_administrator->upline_id = Auth::user()->id;
        $create_sub_administrator->save();
        return back()->with('success','Sub-Administratror Saved Successfully');
    }

    public function sub_administrator_edit(Request $request)
    {
        $sub_ad_edit = sub_administrator::where('id',$request->edit_sub_ad)->first();
        $sub_ad_edit->name = $request->name;
        $sub_ad_edit->user_name = $request->user_name;
        $sub_ad_edit->cradit = $request->cradit;
        $sub_ad_edit->password = encrypt($request->password);
        $sub_ad_edit->upline_id = Auth::user()->id;
        $sub_ad_edit->save();
        return back()->with('success','Sub-Administratror Updated Successfully');

    }

    public function sub_administrator_delete(Request $request)
    {
        $sub_ad_del = sub_administrator::where('id',$request->delete_sub_ad)->first();
        $sub_ad_del->delete();
        return back()->with('success','Sub-Administratror Deleted Successfully');
    }

    public function reseller()
    {
        $all_reseller = Reseller::paginate(15);
        return view('admin.usernavigation.reseller',compact('all_reseller'));
    }

    public function reseller_create(Request $request)
    {
        $new_reseller = new Reseller();
        $new_reseller->name = $request->name;
        $new_reseller->user_name = $request->user_name;
        $new_reseller->cradit = $request->cradit;
        $new_reseller->password = encrypt($request->password);
        $new_reseller->upline_id = Auth::user()->id;
        $new_reseller->save();
        return back()->with('success','Reseller Created Successfully');
    }

    public function reseller_edit(Request $request)
    {
        $reseller_edit = Reseller::where('id',$request->edit_res)->first();
        $reseller_edit->name = $request->name;
        $reseller_edit->user_name = $request->user_name;
        $reseller_edit->cradit = $request->cradit;
        $reseller_edit->password = encrypt($request->password);
        $reseller_edit->upline_id = Auth::user()->id;
        $reseller_edit->save();
        return back()->with('success','Reseller Updated Successfully');
    }

    public function reseller_delete(Request $request)
    {
        $del_reseller = Reseller::where('id',$request->delete_reseller)->first();
        $del_reseller->delete();
        return back()->with('success','Reseller Deleted Successfully');
    }

    public function sub_reseller()
    {
        $all_sub_reseller = Subreseller::paginate(15);
        return view('admin.usernavigation.sub-reseller',compact('all_sub_reseller'));
    }

    public function sub_reseller_create(Request $request)
    {
        $new_sub_reseller = new Subreseller();
        $new_sub_reseller->name = $request->name;
        $new_sub_reseller->user_name = $request->user_name;
        $new_sub_reseller->cradit = $request->cradit;
        $new_sub_reseller->password = encrypt($request->password);
        $new_sub_reseller->upline_id = Auth::user()->id;
        $new_sub_reseller->save();
        return back()->with('success','Sub-Reseller Created Successfully');
    }


    public function sub_reseller_edit(Request $request)
    {
        $edit_sub_reselelr = Subreseller::where('id',$request->edit_subres)->first();
        $edit_sub_reselelr->name = $request->name;
        $edit_sub_reselelr->user_name = $request->user_name;
        $edit_sub_reselelr->cradit = $request->cradit;
        $edit_sub_reselelr->password = encrypt($request->password);
        $edit_sub_reselelr->upline_id = Auth::user()->id;
        $edit_sub_reselelr->save();
        return back()->with('success','Sub-Reseller Updated Successfully');
    }

    public function sub_reseller_delete(Request $request)
    {
        $delete_sub_res = Subreseller::where('id',$request->delete_subreseller)->first();
        $delete_sub_res->delete();
        return back()->with('success','Sub-Reseller Deleted Successfully');
    }
}
