<?php

namespace App\Http\Controllers;

use App\Reseller;
use App\Subreseller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResellerDataController extends Controller
{
    public function reseller()
    {
        $all_sub_reseller = Subreseller::where('reseller_id',Auth::user()->id)->paginate(15);
        return view('resellerdata.sebreseller.reseller',compact('all_sub_reseller'));
    }

    public function reseller_create()
    {
        return view('resellerdata.sebreseller.reseller-create');
    }

    public function reseller_save(Request $request)
    {
        $new_sub_reseller = new Subreseller();
        $new_sub_reseller->name = $request->name;
        $new_sub_reseller->user_name = $request->user_name;
        $new_sub_reseller->cradit = $request->cradit;
        $new_sub_reseller->password = Hash::make($request->password);
        $new_sub_reseller->pass_rep = $request->password;
        $new_sub_reseller->reseller_id = Auth::user()->id;
        $new_sub_reseller->is_block = 0;
        $new_sub_reseller->save();
        return redirect(route('reseller.sub.reseller'))->with('success','Sub-Reseller Created Successfully');
    }

    public function reseller_edit($id)
    {
        $subresl = Subreseller::where('id',$id)->first();
        return view('resellerdata.sebreseller.reseller-edit',compact('subresl'));
    }

    public function reseller_update(Request $request)
    {
        $edit_sub_reselelr = Subreseller::where('id',$request->edit_subres)->first();
        $edit_sub_reselelr->name = $request->name;
        $edit_sub_reselelr->user_name = $request->user_name;
        $edit_sub_reselelr->cradit = $request->cradit;
        $edit_sub_reselelr->password = Hash::make($request->password);
        $edit_sub_reselelr->pass_rep = $request->password;
        $edit_sub_reselelr->administrator_id = Auth::user()->id;
        $edit_sub_reselelr->is_block = 0;
        $edit_sub_reselelr->save();
        return redirect(route('reseller.sub.reseller'))->with('success','Sub-Reseller Updated Successfully');
    }

    public function reseller_delete(Request $request)
    {
        $delete_sub_res = Subreseller::where('id',$request->delete_subreseller)->first();
        $delete_sub_res->delete();
        return redirect(route('reseller.sub.reseller'))->with('success','Sub-Reseller Deleted Successfully');
    }

    public function reseller_block(Request $request)
    {
        $sub_reseller_blcok = Subreseller::where('id',$request->block_subreseller)->first();
        $sub_reseller_blcok->is_block = 1;
        $sub_reseller_blcok->save();
        return redirect(route('reseller.sub.reseller'))->with('success','Sub-Reseller Blocked Successfully');
    }

    public function reseller_unblock(Request $request)
    {
        $sub_reseller_unblcok = Subreseller::where('id',$request->unblock_subreseller)->first();
        $sub_reseller_unblcok->is_block = 0;
        $sub_reseller_unblcok->save();
        return redirect(route('reseller.sub.reseller'))->with('success','Sub-Reseller Unblocked Successfully');
    }

    public function reseller_cradit(Request $request)
    {
        $sub_res_add_cr = Subreseller::where('id',$request->add_crdt)->first();
        $sub_res_add_cr->cradit = $sub_res_add_cr->cradit + $request->cradit;
        $sub_res_add_cr->exp_date = Carbon::now()->addMonth($request->cradit);
        $sub_res_add_cr->save();
        return redirect(route('reseller.sub.reseller'))->with('success','Cradit Added Successfully');
    }

    public function free_user()
    {
        $all_free_user = User::where('reseller_id',Auth::user()->id)->paginate(15);
        return view('resellerdata.freeuser.freeuser',compact('all_free_user'));
    }

    public function free_user_create()
    {
        return view('resellerdata.freeuser.freeuser-create');
    }

    public function free_user_save(Request $request)
    {
        $user = Reseller::where('id',Auth::user()->id)->first();
        if ($user->cradit > $request->cradit)
        {
            return back()->with('alert','Sorry ! Insuficient Cradit');
        }else{
            $free_user = new User();
            $free_user->name = $request->name;
            $free_user->user_name = $request->user_name;
            $free_user->cradit = $request->cradit;
            $free_user->exp_date = Carbon::now()->addMonth($request->cradit);
            $free_user->password = Hash::make($request->password);
            $free_user->pass_rep = $request->password;
            $free_user->reseller_id = Auth::user()->id;
            $free_user->is_block = 0;
            $free_user->is_exp = null;
            $free_user->save();

            $user->cradit = $request->cradit;
            $user->save();

            return redirect(route('reseller.freeuser'))->with('success','Free User Created Successfully');
        }
    }

    public function free_user_edit($id)
    {
        $edit_free_user = User::where('id',$id)->first();
        return view('resellerdata.freeuser.freeuser-edit',compact('edit_free_user'));
    }

    public function free_user_update(Request $request)
    {
        $edit_user = User::where('id',$request->edit_free_user)->first();
        $edit_user->name = $request->name;
        $edit_user->user_name = $request->user_name;
        $edit_user->cradit = $request->cradit;
        $edit_user->exp_date = Carbon::now()->addMonth($request->cradit);
        $edit_user->password = Hash::make($request->password);
        $edit_user->pass_rep = $request->password;
        $edit_user->reseller_id = Auth::user()->id;
        $edit_user->is_block = 0;
        $edit_user->is_exp = null;
        $edit_user->save();
        return redirect(route('reseller.freeuser'))->with('success','Free User Updated Successfully');
    }

    public function free_user_delete(Request $request)
    {
        $delete_free_user = User::where('id',$request->delete_fre_user)->first();
        $delete_free_user->delete();
        return redirect(route('reseller.freeuser'))->with('success','Free User Deleted Successfully');
    }

    public function free_user_block(Request $request)
    {
        $blcok_free_user = User::where('id',$request->block_free_user)->first();
        $blcok_free_user->is_block = 1;
        $blcok_free_user->save();
        return back()->with('success','Free User Blocked Successfully');
    }

    public function free_user_unblock(Request $request)
    {
        $unblcok_free_user = User::where('id',$request->unblock_free_user)->first();
        $unblcok_free_user->is_block = 0;
        $unblcok_free_user->save();
        return back()->with('success','Free User Unblocked Successfully');
    }

    public function free_user_cradit(Request $request)
    {
        $free_user_crd_ad = User::where('id',$request->add_crdt)->first();
        $free_user_crd_ad->cradit = $free_user_crd_ad->cradit + $request->cradit;
        $free_user_crd_ad->exp_date = Carbon::now()->addMonth($request->cradit);
        $free_user_crd_ad->save();
        return back()->with('success','Cradit Added Successfully');
    }

    public function quick_user()
    {
        return view('resellerdata.freeuser.quick-user');
    }

    public function quick_user_save(Request $request)
    {
        $uss = Reseller::where('id',Auth::user()->id)->first();
        if ($uss->cradit <= 0)
        {
            return back()->with('alert','Insuficient Cradit');
        }else{
            $user = new User();
            $user->user_name = $request->user_name;
            $user->password = Hash::make($request->password);
            $user->pass_rep = $request->password;
            $user->reseller_id = Auth::user()->id;
            $user->exp_date = Carbon::now()->addMonth(1);
            $user->is_block = 0;
            $user->cradit = 1;
            $user->save();

            $us = Reseller::where('id',Auth::user()->id)->first();
            $us->cradit = $us->cradit - 1;
            $us->save();
        }
        return redirect(route('reseller.freeuser'))->with('success','User Created');
    }
}
