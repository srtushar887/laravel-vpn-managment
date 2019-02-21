<?php

namespace App\Http\Controllers;

use App\Reseller;
use App\sub_administrator;
use App\Subreseller;
use Carbon\Carbon;
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


    public function create_sub_administrator()
    {
        return view('admin.subadministratror.create');
    }

    public function sub_administrator_save(Request $request)
    {
        $create_sub_administrator = new sub_administrator();
        $create_sub_administrator->name = $request->name;
        $create_sub_administrator->user_name = $request->user_name;
        $create_sub_administrator->cradit = $request->cradit;
        $create_sub_administrator->exp_date = Carbon::now()->addMonth($request->cradit);
        $create_sub_administrator->is_exp = 0;
        $create_sub_administrator->is_active = 0;
        $create_sub_administrator->password = encrypt($request->password);
        $create_sub_administrator->upline_id = Auth::user()->id;
        $create_sub_administrator->save();
        return back()->with('success','Sub-Administratror Saved Successfully');
    }

    public function sub_administrator_edit_data($id)
    {
        $subad = sub_administrator::where('id',$id)->first();
        return view('admin.subadministratror.edit',compact('subad'));
    }



    public function sub_administrator_edit(Request $request)
    {
        $sub_ad_edit = sub_administrator::where('id',$request->edit_sub_ad)->first();
        $sub_ad_edit->name = $request->name;
        $sub_ad_edit->user_name = $request->user_name;
        $sub_ad_edit->cradit = $request->cradit;
        $sub_ad_edit->exp_date = Carbon::now()->addMonth($request->cradit);
        $sub_ad_edit->is_exp = 0;
        $sub_ad_edit->is_active = 0;
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

    public function sub_administrator_chnage_permision($id)
    {
        $users_data = sub_administrator::where('id',$id)->first();
        return view('admin.subadministratror.sub-administrator-chnage-permison',compact('users_data'));
    }

    public function sub_administrator_chnage_permision_save(Request $request)
    {

        $chnag = $request->chnage_per;
        if ($chnag == 2)
        {
            $new_reseller = new Reseller();
            $new_reseller->name = $request->name;
            $new_reseller->user_name = $request->user_name;
            $new_reseller->cradit = $request->cradit;
            $new_reseller->password = encrypt($request->password);
            $new_reseller->upline_id = Auth::user()->id;
            $new_reseller->save();

            $del_reseller = sub_administrator::where('id',$request->id)->first();
            $del_reseller->delete();
            return redirect(route('admin.sub.administratio'))->with('success','Reseller Created Successfully');
        }

        if ($chnag == 3)
        {
            $new_sub_reseller = new Subreseller();
            $new_sub_reseller->name = $request->name;
            $new_sub_reseller->user_name = $request->user_name;
            $new_sub_reseller->cradit = $request->cradit;
            $new_sub_reseller->password = encrypt($request->password);
            $new_sub_reseller->upline_id = Auth::user()->id;
            $new_sub_reseller->save();

            $delete_sub_res = sub_administrator::where('id',$request->id)->first();
            $delete_sub_res->delete();
            return redirect(route('admin.sub.reseller'))->with('success','Sub-Reseller Created Successfully');
        }

    }

    public function sub_administrator_block(Request $request)
    {
        $block_sub_add = sub_administrator::where('id',$request->block_sub_ad)->first();
        $block_sub_add->is_active = 1;
        $block_sub_add->save();
        return back()->with('success','Sub-Administratror Blocked Successfully');
    }


    public function reseller()
    {
        $all_reseller = Reseller::paginate(15);
        return view('admin.usernavigation.reseller',compact('all_reseller'));
    }

    public function create_reseller()
    {
        return view('admin.usernavigation.create-reseller');
    }

    public function reseller_create(Request $request)
    {
        $new_reseller = new Reseller();
        $new_reseller->name = $request->name;
        $new_reseller->user_name = $request->user_name;
        $new_reseller->cradit = $request->cradit;
        $new_reseller->password = encrypt($request->password);
        $new_reseller->upline_id = Auth::user()->id;
        $new_reseller->is_block = 0;
        $new_reseller->save();
        return back()->with('success','Reseller Created Successfully');
    }

    public function reseller_edit_data($id)
    {
        $resl = Reseller::where('id',$id)->first();
        return view('admin.usernavigation.edit-reseller',compact('resl'));
    }

    public function reseller_edit(Request $request)
    {
        $reseller_edit = Reseller::where('id',$request->edit_sub_ad)->first();
        $reseller_edit->name = $request->name;
        $reseller_edit->user_name = $request->user_name;
        $reseller_edit->cradit = $request->cradit;
        $reseller_edit->password = encrypt($request->password);
        $reseller_edit->upline_id = Auth::user()->id;
        $reseller_edit->is_block = 0;
        $reseller_edit->save();
        return back()->with('success','Reseller Updated Successfully');
    }

    public function reseller_delete(Request $request)
    {
        $del_reseller = Reseller::where('id',$request->delete_reseller)->first();
        $del_reseller->delete();
        return back()->with('success','Reseller Deleted Successfully');
    }

    public function reseller_permission_chnage($id)
    {
        $user_data = Reseller::where('id',$id)->first();
        return view('admin.usernavigation.reseller-permission-chnage',compact('user_data'));
    }

    public function reseller_permission_chnage_save(Request $request)
    {
        $per = $request->chnage_per;
        if ($per == 2)
        {
            $create_sub_administrator = new sub_administrator();
            $create_sub_administrator->name = $request->name;
            $create_sub_administrator->user_name = $request->user_name;
            $create_sub_administrator->cradit = $request->cradit;
            $create_sub_administrator->is_exp = 0;
            $create_sub_administrator->password = encrypt($request->password);
            $create_sub_administrator->upline_id = Auth::user()->id;
            $create_sub_administrator->save();

            $del_reseller = Reseller::where('id',$request->id)->first();
            $del_reseller->delete();
            return redirect(route('admin.reseller'))->with('success','Reseller Created Successfully');
        }

        if ($per == 3)
        {
            $new_sub_reseller = new Subreseller();
            $new_sub_reseller->name = $request->name;
            $new_sub_reseller->user_name = $request->user_name;
            $new_sub_reseller->cradit = $request->cradit;
            $new_sub_reseller->password = encrypt($request->password);
            $new_sub_reseller->upline_id = Auth::user()->id;
            $new_sub_reseller->save();

            $delete_sub_res = Reseller::where('id',$request->id)->first();
            $delete_sub_res->delete();
            return redirect(route('admin.reseller'))->with('success','Sub-Reseller Created Successfully');
        }
    }

    public function reseller_block(Request $request)
    {
        $block_reseller = Reseller::where('id',$request->block_reseller)->first();
        $block_reseller->is_block = 1;
        $block_reseller->save();
        return back()->with('success','Reseller Blocked Successfully');
    }

    public function sub_reseller()
    {
        $all_sub_reseller = Subreseller::paginate(15);
        return view('admin.usernavigation.sub-reseller',compact('all_sub_reseller'));
    }

    public function sub_reseller_create_new()
    {
        return view('admin.usernavigation.create-sub-reseller');
    }

    public function sub_reseller_create(Request $request)
    {
        $new_sub_reseller = new Subreseller();
        $new_sub_reseller->name = $request->name;
        $new_sub_reseller->user_name = $request->user_name;
        $new_sub_reseller->cradit = $request->cradit;
        $new_sub_reseller->password = encrypt($request->password);
        $new_sub_reseller->upline_id = Auth::user()->id;
        $new_sub_reseller->is_block = 0;
        $new_sub_reseller->save();
        return redirect(route('admin.sub.reseller'))->with('success','Sub-Reseller Created Successfully');
    }

    public function sub_reseller_edit_data($id)
    {
        $subresl = Subreseller::where('id',$id)->first();
        return view('admin.usernavigation.edit-sub-reseller',compact('subresl'));
    }


    public function sub_reseller_edit(Request $request)
    {
        $edit_sub_reselelr = Subreseller::where('id',$request->edit_subres)->first();
        $edit_sub_reselelr->name = $request->name;
        $edit_sub_reselelr->user_name = $request->user_name;
        $edit_sub_reselelr->cradit = $request->cradit;
        $edit_sub_reselelr->password = encrypt($request->password);
        $edit_sub_reselelr->upline_id = Auth::user()->id;
        $edit_sub_reselelr->is_block = 0;
        $edit_sub_reselelr->save();
        return back()->with('success','Sub-Reseller Updated Successfully');
    }

    public function sub_reseller_delete(Request $request)
    {
        $delete_sub_res = Subreseller::where('id',$request->delete_subreseller)->first();
        $delete_sub_res->delete();
        return back()->with('success','Sub-Reseller Deleted Successfully');
    }


    public function sub_reseller_permission_chnage($id)
    {
        $user_data = Subreseller::where('id',$id)->first();
        return view('admin.usernavigation.sub-reseller-permission-chnage',compact('user_data'));
    }

    public function sub_reseller_permission_chnage_save(Request $request)
    {
        $per = $request->chnage_per;
        if ($per ==  2)
        {
            $create_sub_administrator = new sub_administrator();
            $create_sub_administrator->name = $request->name;
            $create_sub_administrator->user_name = $request->user_name;
            $create_sub_administrator->cradit = $request->cradit;
            $create_sub_administrator->is_exp = 0;
            $create_sub_administrator->password = encrypt($request->password);
            $create_sub_administrator->upline_id = Auth::user()->id;
            $create_sub_administrator->save();

            $del_reseller = Subreseller::where('id',$request->id)->first();
            $del_reseller->delete();
            return redirect(route('admin.sub.reseller'))->with('success','Reseller Created Successfully');
        }

        if ($per == 3)
        {
            $new_reseller = new Reseller();
            $new_reseller->name = $request->name;
            $new_reseller->user_name = $request->user_name;
            $new_reseller->cradit = $request->cradit;
            $new_reseller->password = encrypt($request->password);
            $new_reseller->upline_id = Auth::user()->id;
            $new_reseller->save();

            $del_reseller = Subreseller::where('id',$request->id)->first();
            $del_reseller->delete();
            return redirect(route('admin.sub.reseller'))->with('success','Reseller Created Successfully');
        }

    }


    public function sub_reseller_block(Request $request)
    {
        $sub_reseller_blcok = Subreseller::where('id',$request->block_subreseller)->first();
        $sub_reseller_blcok->is_block = 1;
        $sub_reseller_blcok->save();
        return back()->with('success','Sub-Reseller Blocked Successfully');
    }


    public function create_quick_user()
    {
        return view('admin.usernavigation.create-quick-user');
    }

    public function create_quick_user_save(Request $request)
    {
        $per = $request->sel_per;

        if ($per == 1)
        {
            $save_sub_admin = new sub_administrator();
            $save_sub_admin->user_name = $request->user_name;
            $save_sub_admin->password = encrypt($request->password);
            $save_sub_admin->save();
            return back()->with('success','Quick User Created Successfully');
        }

        if ($per == 2)
        {
            $save_resel = new Reseller();
            $save_resel->user_name = $request->user_name;
            $save_resel->password = encrypt($request->password);
            $save_resel->save();
            return back()->with('success','Quick User Created Successfully');
        }

        if ($per == 3)
        {
            $save_sub_resel = new Subreseller();
            $save_sub_resel->user_name = $request->user_name;
            $save_sub_resel->password = encrypt($request->password);
            $save_sub_resel->save();
            return back()->with('success','Quick User Created Successfully');

        }
    }

}
