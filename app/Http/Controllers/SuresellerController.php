<?php

namespace App\Http\Controllers;

use App\Subreseller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuresellerController extends Controller
{
    public function index()
    {
        return view('subreseller.index');
    }


    public function vpn_user()
    {
        $all_free_user = User::where('subreseller_id',Auth::user()->id)->paginate(15);
        return view('subreseller.freeuser.vpn-user',compact('all_free_user'));
    }

    public function vpn_user_create()
    {
        return view('subreseller.freeuser.vpn-user-create');
    }

    public function vpn_user_save(Request $request)
    {
        $user = Subreseller::where('id',Auth::user()->id)->first();
        if ($user->cradit <= 0)
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
            $free_user->subreseller_id = Auth::user()->id;
            $free_user->is_block = 0;
            $free_user->is_exp = null;
            $free_user->save();

            $user->cradit = $request->cradit;
            $user->save();

            return redirect(route('subreseller.freeuser'))->with('success','Free User Created Successfully');
        }
    }

    public function vpn_user_edit($id)
    {
        $edit_free_user = User::where('id',$id)->first();
        return view('subreseller.freeuser.vpn-user-edit',compact('edit_free_user'));
    }

    public function vpn_user_update(Request $request)
    {
        $edit_user = User::where('id',$request->edit_free_user)->first();
        $edit_user->name = $request->name;
        $edit_user->user_name = $request->user_name;
        $edit_user->cradit = $request->cradit;
        $edit_user->exp_date = Carbon::now()->addMonth($request->cradit);
        $edit_user->password = Hash::make($request->password);
        $edit_user->pass_rep = $request->password;
        $edit_user->subreseller_id = Auth::user()->id;
        $edit_user->is_block = 0;
        $edit_user->is_exp = null;
        $edit_user->save();
        return redirect(route('subreseller.freeuser'))->with('success','Free User Updated Successfully');
    }

    public function vpn_user_delete(Request $request)
    {
        $delete_free_user = User::where('id',$request->delete_fre_user)->first();
        $delete_free_user->delete();
        return redirect(route('subreseller.freeuser'))->with('success','Free User Deleted Successfully');
    }

    public function vpn_user_block(Request $request)
    {
        $blcok_free_user = User::where('id',$request->block_free_user)->first();
        $blcok_free_user->is_block = 1;
        $blcok_free_user->save();
        return back()->with('success','Free User Blocked Successfully');
    }

    public function vpn_user_unblock(Request $request)
    {
        $unblcok_free_user = User::where('id',$request->unblock_free_user)->first();
        $unblcok_free_user->is_block = 0;
        $unblcok_free_user->save();
        return back()->with('success','Free User Unblocked Successfully');
    }

    public function vpn_user_cradit(Request $request)
    {
        $free_user_crd_ad = User::where('id',$request->add_crdt)->first();
        $free_user_crd_ad->cradit = $free_user_crd_ad->cradit + $request->cradit;
        $free_user_crd_ad->exp_date = Carbon::now()->addMonth($request->cradit);
        $free_user_crd_ad->save();
        return back()->with('success','Cradit Added Successfully');
    }

    public function quick_user()
    {
        return view('subreseller.freeuser.quick-user');
    }

    public function quick_user_save(Request $request)
    {
        $uss = Subreseller::where('id',Auth::user()->id)->first();
        if ($uss->cradit <= 0)
        {
            return back()->with('alert','Insuficient Cradit');
        }else{
            $user = new User();
            $user->user_name = $request->user_name;
            $user->password = Hash::make($request->password);
            $user->pass_rep = $request->password;
            $user->subreseller_id = Auth::user()->id;
            $user->exp_date = Carbon::now()->addMonth(1);
            $user->is_block = 0;
            $user->cradit = 1;
            $user->save();

            $us = Subreseller::where('id',Auth::user()->id)->first();
            $us->cradit = $us->cradit - 1;
            $us->save();
        }
        return redirect(route('subreseller.freeuser'))->with('success','User Created');
    }

}
