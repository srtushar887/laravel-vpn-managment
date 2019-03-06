<?php

namespace App\Http\Controllers;

use App\Reseller;
use App\sub_administrator;
use App\Subreseller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class AdministratorDataController extends Controller
{
    public function reseller()
    {
        $all_resl = Reseller::where('administrator_id',Auth::user()->id)->paginate(15);
        return view('administrator.reseller.reseller',compact('all_resl'));
    }

    public function reseller_create()
    {
        return view('administrator.reseller.reseller-create');
    }

    public function reseller_save(Request $request)
    {
        $user = sub_administrator::where('id',Auth::user()->id)->first();

        if ($user->cradit < $request->cradit){
            return back()->with('alert','Insuficient Balance');
        }else{
            $new_reseller = new Reseller();
            $new_reseller->name = $request->name;
            $new_reseller->user_name = $request->user_name;
            $new_reseller->cradit = $request->cradit;
            $new_reseller->password = Hash::make($request->password);
            $new_reseller->pass_rep = $request->password;
            $new_reseller->administrator_id = Auth::user()->id;
            $new_reseller->is_block = 0;
            $new_reseller->save();

            $users = sub_administrator::where('id',Auth::user()->id)->first();
            $users->cradit = $users->cradit - $request->cradit;
            $user->save();

            return back()->with('success','Reseller Created Successfully');
        }

    }

    public function reseller_edit($id)
    {
        $resl = Reseller::where('id',$id)->first();
        return view('administrator.reseller.reseller-edit',compact('resl'));
    }

    public function reseller_update(Request $request)
    {
        $user = sub_administrator::where('id', Auth::user()->id)->first();

        if ($user->cradit < $request->cradit) {
            return back()->with('alert', 'Insuficient Balance');
        } else {
            $reseller_edit = Reseller::where('id', $request->edit_sub_ad)->first();
            $reseller_edit->name = $request->name;
            $reseller_edit->user_name = $request->user_name;
            $reseller_edit->cradit = $request->cradit;
            $reseller_edit->password = Hash::make($request->password);
            $reseller_edit->pass_rep = $request->password;
            $reseller_edit->administrator_id = Auth::user()->id;
            $reseller_edit->is_block = 0;
            $reseller_edit->save();
            $users = sub_administrator::where('id', Auth::user()->id)->first();
            $users->cradit = $users->cradit - $request->cradit;
            $user->save();
            return back()->with('success', 'Reseller Updated Successfully');
        }
    }

    public function reseller_delete(Request $request)
    {
        $del_reseller = Reseller::where('id',$request->delete_reseller)->first();
        $del_reseller->delete();
        return back()->with('success','Reseller Deleted Successfully');
    }

    public function reseller_change_permisiion($id)
    {
        $user_data = Reseller::where('id',$id)->first();
        return view('administrator.reseller.reseller-change-permission',compact('user_data'));
    }

    public function reseller_change_permisiion_save(Request $request)
    {
        $new_sub_reseller = new Subreseller();
        $new_sub_reseller->name = $request->name;
        $new_sub_reseller->user_name = $request->user_name;
        $new_sub_reseller->cradit = $request->cradit;
        $new_sub_reseller->password = Hash::make($request->password);
        $new_sub_reseller->pass_rep = $request->password;
        $new_sub_reseller->administrator_id = Auth::user()->id;
        $new_sub_reseller->is_block = 0;
        $new_sub_reseller->save();

        $delete_sub_res = Reseller::where('id',$request->id)->first();
        $delete_sub_res->delete();
        return redirect(route('administrator.reseller'))->with('success','Sub-Reseller Created Successfully');
    }

    public function reseller_change_block(Request $request)
    {
        $block_reseller = Reseller::where('id',$request->block_reseller)->first();
        $block_reseller->is_block = 1;
        $block_reseller->save();
        return back()->with('success','Reseller Blocked Successfully');
    }

    public function reseller_change_unblock(Request $request)
    {
        $unblock_reseller = Reseller::where('id',$request->unblock_reseller)->first();
        $unblock_reseller->is_block = 0;
        $unblock_reseller->save();
        return back()->with('success','Reseller Unblocked Successfully');
    }

    public function reseller_cradit_add(Request $request)
    {
        $user = Auth::user()->cradit;
        if ($user < $request->cradit)
        {
            return back()->with('alert','Sorry ! Insuficient Cradit');
        }else{
            $r_cr_add = Reseller::where('id',$request->add_crdt)->first();
            $r_cr_add->cradit = $r_cr_add->cradit + $request->cradit;
            $r_cr_add->exp_date = Carbon::now()->addMonth($request->cradit);
            $r_cr_add->save();
            return back()->with('success','Cradit Added Successfully');
        }
    }

    public function reseller_search(Request $request)
    {
        $search = $request->search;
        $reseller_search = Reseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('administrator.reseller.reseller-search',compact('reseller_search'));

    }



    public function sub_reseller()
    {
        $all_sub_reseller = Subreseller::where('administrator_id',Auth::user()->id)->paginate(15);
        return view('administrator.subreseller.subreseller',compact('all_sub_reseller'));
    }

    public function subrelsearch(Request $request)
    {
        return 'ok';
    }

    public function vpn_user_search(Request $request)
    {
        $search = $request->search;
        $user = User::where('user_name','LIKE','%'.$search.'%')->get();
        return view('administrator.freeuser.freeuser-search',compact('user'));

    }

    public function sub_reseller_create()
    {
        return view('administrator.subreseller.subreseller-create');
    }

    public function sub_reseller_save(Request $request)
    {
        $user = sub_administrator::where('id', Auth::user()->id)->first();

        if ($user->cradit < $request->cradit) {
            return back()->with('alert', 'Insuficient Balance');
        } else {
            $new_sub_reseller = new Subreseller();
            $new_sub_reseller->name = $request->name;
            $new_sub_reseller->user_name = $request->user_name;
            $new_sub_reseller->cradit = $request->cradit;
            $new_sub_reseller->password = Hash::make($request->password);
            $new_sub_reseller->pass_rep = $request->password;
            $new_sub_reseller->administrator_id = Auth::user()->id;
            $new_sub_reseller->is_block = 0;
            $new_sub_reseller->save();
            $users = sub_administrator::where('id', Auth::user()->id)->first();
            $users->cradit = $users->cradit - $request->cradit;
            $user->save();
            return redirect(route('administrator.sub.reseller'))->with('success', 'Sub-Reseller Created Successfully');
        }
    }

    public function sub_reseller_edit($id)
    {
        $subresl = Subreseller::where('id',$id)->first();
        return view('administrator.subreseller.subreseller-edit',compact('subresl'));
    }

    public function sub_reseller_update(Request $request)
    {
        $user = sub_administrator::where('id', Auth::user()->id)->first();

        if ($user->cradit < $request->cradit) {
            return back()->with('alert', 'Insuficient Balance');
        } else {
            $edit_sub_reselelr = Subreseller::where('id', $request->edit_subres)->first();
            $edit_sub_reselelr->name = $request->name;
            $edit_sub_reselelr->user_name = $request->user_name;
            $edit_sub_reselelr->cradit = $request->cradit;
            $edit_sub_reselelr->password = Hash::make($request->password);
            $edit_sub_reselelr->pass_rep = $request->password;
            $edit_sub_reselelr->administrator_id = Auth::user()->id;
            $edit_sub_reselelr->is_block = 0;
            $edit_sub_reselelr->save();

            $users = sub_administrator::where('id', Auth::user()->id)->first();
            $users->cradit = $users->cradit - $request->cradit;
            $user->save();
            return back()->with('success', 'Sub-Reseller Updated Successfully');
        }
    }

    public function sub_reseller_cahnage_permission($id)
    {
        $user_data = Subreseller::where('id',$id)->first();
        return view('administrator.subreseller.subreseller-permission',compact('user_data'));
    }

    public function sub_reseller_cahnage_permission_save(Request $request)
    {
        $new_reseller = new Reseller();
        $new_reseller->name = $request->name;
        $new_reseller->user_name = $request->user_name;
        $new_reseller->cradit = $request->cradit;
        $new_reseller->password = Hash::make($request->password);
        $new_reseller->pass_rep = $request->password;
        $new_reseller->administrator_id = Auth::user()->id;
        $new_reseller->save();

        $del_reseller = Subreseller::where('id',$request->id)->first();
        $del_reseller->delete();
        return redirect(route('administrator.sub.reseller'))->with('success','Reseller Created Successfully');
    }

    public function sub_reseller_delete(Request $request)
    {
        $delete_sub_res = Subreseller::where('id',$request->delete_subreseller)->first();
        $delete_sub_res->delete();
        return back()->with('success','Sub-Reseller Deleted Successfully');
    }

    public function sub_reseller_block(Request $request)
    {
        $sub_reseller_blcok = Subreseller::where('id',$request->block_subreseller)->first();
        $sub_reseller_blcok->is_block = 1;
        $sub_reseller_blcok->save();
        return back()->with('success','Sub-Reseller Blocked Successfully');
    }

    public function sub_reseller_unblock(Request $request)
    {
        $sub_reseller_unblcok = Subreseller::where('id',$request->unblock_subreseller)->first();
        $sub_reseller_unblcok->is_block = 0;
        $sub_reseller_unblcok->save();
        return back()->with('success','Sub-Reseller Unblocked Successfully');
    }

    public function sub_reseller_add_cradit(Request $request)
    {
        $sub_res_add_cr = Subreseller::where('id',$request->add_crdt)->first();
        $sub_res_add_cr->cradit = $sub_res_add_cr->cradit + $request->cradit;
        $sub_res_add_cr->exp_date = Carbon::now()->addMonth($request->cradit);
        $sub_res_add_cr->save();

        $users = sub_administrator::where('id',Auth::user()->id)->first();
        $users->cradit = $users->cradit - $request->cradit;
        $user->save();
        return back()->with('success','Cradit Added Successfully');
    }

    public function vpn_user()
    {
        $all_free_user = User::where('administrator_id',Auth::user()->id)->paginate(15);
        return view('administrator.freeuser.vpn-user',compact('all_free_user'));
    }

    public function vpn_user_craete()
    {
        return view('administrator.freeuser.vpn-user-create');
    }

    public function vpn_user_store(Request $request)
    {
        $user = sub_administrator::where('id',Auth::user()->id)->first();
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
            $free_user->administrator_id = Auth::user()->id;
            $free_user->is_block = 0;
            $free_user->is_exp = null;
            $free_user->save();

            $user->cradit = $request->cradit;
            $user->save();

            return back()->with('success','Free User Created Successfully');
        }

    }

    public function vpn_user_edit($id)
    {
        $edit_free_user = User::where('id',$id)->first();
        return view('administrator.freeuser.vpn-user-edit',compact('edit_free_user'));
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
        $edit_user->administrator_id = Auth::user()->id;
        $edit_user->is_block = 0;
        $edit_user->is_exp = null;
        $edit_user->save();
        return back()->with('success','Free User Updated Successfully');
    }

    public function vpn_user_delete(Request $request)
    {
        $delete_free_user = User::where('id',$request->delete_fre_user)->first();
        $delete_free_user->delete();
        return back()->with('success','Free User Deleted Successfully');
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
        return view('administrator.freeuser.quick-user');
    }

    public function quick_user_save(Request $request)
    {
        $uss = sub_administrator::where('id',Auth::user()->id)->first();
        if ($uss->cradit <= 0)
        {
            return back()->with('alert','Insuficient Cradit');
        }else{
        $user = new User();
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);
        $user->pass_rep = $request->pass_rep;
        $user->administrator_id = Auth::user()->id;
        $user->exp_date = Carbon::now()->addMonth(1);
        $user->is_block = 0;
        $user->cradit = 1;
        $user->save();

            $us = sub_administrator::where('id',Auth::user()->id)->first();
            $us->cradit = $us->cradit - 1;
            $us->save();
        }
        return redirect(route('administrator.freeuser'))->with('success','User Created');

    }


}
