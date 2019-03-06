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
//        $create_sub_administrator->password = encrypt($request->password);
        $create_sub_administrator->password = Hash::make($request->password);
        $create_sub_administrator->pass_rep = $request->password;
        $create_sub_administrator->upline_id = Auth::user()->id;
        $create_sub_administrator->save();
        return redirect(route('admin.sub.administratio'))->with('success','Sub-Administratror Saved Successfully');
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
        $sub_ad_edit->password = Hash::make($request->password);
        $sub_ad_edit->pass_rep = $request->password;
        $sub_ad_edit->upline_id = Auth::user()->id;
        $sub_ad_edit->save();
        return redirect(route('admin.sub.administratio'))->with('success','Sub-Administratror Updated Successfully');

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
            $new_reseller->password = Hash::make($request->password);
            $new_reseller->pass_rep = $request->password;
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
            $new_sub_reseller->password = Hash::make($request->password);
            $new_sub_reseller->pass_rep = $request->password;
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

    public function sub_administrator_unblock(Request $request)
    {
        $unblock_sub_add = sub_administrator::where('id',$request->unblock_sub_ad)->first();
        $unblock_sub_add->is_active = 0;
        $unblock_sub_add->save();
        return back()->with('success','Sub-Administratror Unblocked Successfully');
    }

    public function sub_administrator_add_cradit(Request $request)
    {
        $card = sub_administrator::where('id',$request->add_crdt)->first();
        $card->cradit = $card->cradit + $request->cradit;
        $card->exp_date = Carbon::now()->addMonth($request->cradit);
        $card->save();
        return back()->with('success','Cradit Added Successfully');

    }

    public function sub_administrator_search(Request $request)
    {
        $search = $request->search;
        $sub_ad = sub_administrator::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.subadministratror.search-result',compact('sub_ad'));
    }

    public function reseller_search(Request $request)
    {
        $search = $request->search;
        $reseller_sr = Reseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.reseller-search-result',compact('reseller_sr'));
    }

    public function sub_reseller_search(Request $request)
    {
        $search = $request->search;
        $reseller_sr = Subreseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.subreseller-search-result',compact('reseller_sr'));
    }

    public function free_user_search(Request $request)
    {
        $search = $request->search;
        $free_user_sr = Subreseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.freeuser-search-result',compact('free_user_sr'));
    }

    public function sub_administrator_time_search(Request $request)
    {
        $search = $request->search;
        $sub_ad_time = sub_administrator::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.subadministratror.time-search-result',compact('sub_ad_time'));
    }

    public function reseller_time_search(Request $request)
    {
        $search = $request->search;
        $reseller_time_sr = Reseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.reseller-time--search-result',compact('reseller_time_sr'));
    }

    public function sub_reseller_time_search(Request $request)
    {
        $search = $request->search;
        $reseller_time_sr = Subreseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.subreseller-time-search-result',compact('reseller_time_sr'));
    }

    public function sub_administrator_cradit_search(Request $request)
    {
        $search = $request->search;
        $sub_ad_cradit = sub_administrator::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.subadministratror.cradit-search-result',compact('sub_ad_cradit'));
    }

    public function reseller_cradit_search(Request $request)
    {
        $search = $request->search;
        $reseller_cradit_sr = Reseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.reseller-cradit-search-result',compact('reseller_cradit_sr'));
    }

    public function sub_reseller_cradit_search(Request $request)
    {
        $search = $request->search;
        $subreseller_cradit_sr = Subreseller::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.subreseller-cradit-search-result',compact('subreseller_cradit_sr'));
    }

    public function fre_ad_time_search(Request $request)
    {
        $search = $request->search;
        $free_user_time_serach = User::where('user_name','LIKE','%'.$search.'%')->get();
        return view('admin.usernavigation.freeusertimesearch',compact('free_user_time_serach'));
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
        $new_reseller->password = Hash::make($request->password);
        $new_reseller->pass_rep = $request->password;
        $new_reseller->upline_id = Auth::user()->id;
        $new_reseller->is_block = 0;
        $new_reseller->save();
        return redirect(route('admin.reseller'))->with('success','Reseller Created Successfully');
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
        $reseller_edit->password = Hash::make($request->password);
        $reseller_edit->pass_rep = $request->password;
        $reseller_edit->upline_id = Auth::user()->id;
        $reseller_edit->is_block = 0;
        $reseller_edit->save();
        return redirect(route('admin.reseller'))->with('success','Reseller Updated Successfully');
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
            $create_sub_administrator->password = Hash::make($request->password);
            $create_sub_administrator->pass_rep = $request->password;
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
            $new_sub_reseller->password = Hash::make($request->password);
            $new_sub_reseller->pass_rep = $request->password;
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

    public function reseller_unblock(Request $request)
    {
        $unblock_reseller = Reseller::where('id',$request->unblock_reseller)->first();
        $unblock_reseller->is_block = 0;
        $unblock_reseller->save();
        return back()->with('success','Reseller Unblocked Successfully');
    }

    public function reseller_add_cradit(Request $request)
    {
        $r_cr_add = Reseller::where('id',$request->add_crdt)->first();
        $r_cr_add->cradit = $r_cr_add->cradit + $request->cradit;
        $r_cr_add->exp_date = Carbon::now()->addMonth($request->cradit);
        $r_cr_add->save();
        return back()->with('success','Cradit Added Successfully');

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
        $new_sub_reseller->password = Hash::make($request->password);
        $new_sub_reseller->pass_rep = $request->password;
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
        $edit_sub_reselelr->password = Hash::make($request->password);
        $edit_sub_reselelr->pass_rep = $request->password;
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
            $create_sub_administrator->password = Hash::make($request->password);
            $create_sub_administrator->pass_rep = $request->password;
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
            $new_reseller->password = Hash::make($request->password);
            $new_reseller->pass_rep = $request->password;
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
        return back()->with('success','Cradit Added Successfully');
    }


    public function create_quick_user()
    {
        return view('admin.usernavigation.create-quick-user');
    }

    public function create_quick_user_save(Request $request)
    {

        $qp_user = new User();
        $qp_user->user_name = $request->user_name;
        $qp_user->password = encrypt($request->password);
        $qp_user->exp_date = Carbon::now()->addMonth(1);
        $qp_user->upline_id = Auth::user()->id;
        $qp_user->save();
        return redirect(route('admin.freeuser'))->with('success','Quick User Created Successfully');

//        $per = $request->sel_per;
//
//        if ($per == 1)
//        {
//            $save_sub_admin = new sub_administrator();
//            $save_sub_admin->user_name = $request->user_name;
//            $save_sub_admin->password = encrypt($request->password);
//            $save_sub_admin->save();
//            return back()->with('success','Quick User Created Successfully');
//        }
//
//        if ($per == 2)
//        {
//            $save_resel = new Reseller();
//            $save_resel->user_name = $request->user_name;
//            $save_resel->password = encrypt($request->password);
//            $save_resel->save();
//            return back()->with('success','Quick User Created Successfully');
//        }
//
//        if ($per == 3)
//        {
//            $save_sub_resel = new Subreseller();
//            $save_sub_resel->user_name = $request->user_name;
//            $save_sub_resel->password = encrypt($request->password);
//            $save_sub_resel->save();
//            return back()->with('success','Quick User Created Successfully');
//
//        }
    }


    public function free_user()
    {
        $all_free_user = User::paginate(15);
        return view('admin.usernavigation.free-user',compact('all_free_user'));
    }

    public function create_free_user()
    {
        return view('admin.usernavigation.free-user-create');
    }

    public function create_free_user_store(Request $request)
    {
        $free_user = new User();
        $free_user->name = $request->name;
        $free_user->user_name = $request->user_name;
        $free_user->cradit = $request->cradit;
        $free_user->password = Hash::make($request->password);
        $free_user->pass_rep = $request->password;
        $free_user->upline_id = Auth::user()->id;
        $free_user->is_block = 0;
        $free_user->is_block = 0;
        $free_user->is_exp = null;
        $free_user->save();
        return back()->with('success','Free User Created Successfully');


    }

    public function free_user_edit_data($id)
    {
        $edit_free_user = User::where('id',$id)->first();
        return view('admin.usernavigation.free-user-edit',compact('edit_free_user'));
    }

    public function free_user_edit(Request $request)
    {
        $edit_user = User::where('id',$request->edit_free_user)->first();
        $edit_user->name = $request->name;
        $edit_user->user_name = $request->user_name;
        $edit_user->cradit = $request->cradit;
        $edit_user->password = Hash::make($request->password);
        $edit_user->pass_rep = $request->password;
        $edit_user->upline_id = Auth::user()->id;
        $edit_user->is_block = 0;
        $edit_user->is_block = 0;
        $edit_user->is_exp = null;
        $edit_user->save();
        return back()->with('success','Free User Updated Successfully');
    }

    public function free_user_delete(Request $request)
    {
        $delete_free_user = User::where('id',$request->delete_fre_user)->first();
        $delete_free_user->delete();
        return back()->with('success','Free User Deleted Successfully');
    }

    public function free_user_permission_chnage($id)
    {
        $user_permission = User::where('id',$id)->first();
        return view('admin.usernavigation.free-user-permission',compact('user_permission'));
    }

    public function free_user_permission_chnage_save(Request $request)
    {
        $per = $request->chnage_per;
        if ($per == 2)
        {
            $create_sub_administrator = new sub_administrator();
            $create_sub_administrator->name = $request->name;
            $create_sub_administrator->user_name = $request->user_name;
            $create_sub_administrator->cradit = $request->cradit;
            $create_sub_administrator->exp_date = Carbon::now()->addMonth($request->cradit);
            $create_sub_administrator->is_exp = 0;
            $create_sub_administrator->is_active = 0;
            $create_sub_administrator->password = encrypt($request->password);
            $create_sub_administrator->pass_rep = $request->password;
            $create_sub_administrator->upline_id = Auth::user()->id;
            $create_sub_administrator->save();


            $del_user = User::where('id',$request->id)->first();
            $del_user->delete();

            return redirect(route('admin.freeuser'))->with('success','Permission Changed');
        }

        if ($per == 3)
        {
            $new_reseller = new Reseller();
            $new_reseller->name = $request->name;
            $new_reseller->user_name = $request->user_name;
            $new_reseller->cradit = $request->cradit;
            $new_reseller->password = Hash::make($request->password);
            $new_reseller->pass_rep = $request->password;
            $new_reseller->upline_id = Auth::user()->id;
            $new_reseller->save();

            $del_user = User::where('id',$request->id)->first();
            $del_user->delete();
            return redirect(route('admin.freeuser'))->with('success','Permission Changed');

        }

        if ($per == 4)
        {
            $new_sub_reseller = new Subreseller();
            $new_sub_reseller->name = $request->name;
            $new_sub_reseller->user_name = $request->user_name;
            $new_sub_reseller->cradit = $request->cradit;
            $new_sub_reseller->password = Hash::make($request->password);
            $new_sub_reseller->pass_rep = $request->password;
            $new_sub_reseller->upline_id = Auth::user()->id;
            $new_sub_reseller->is_block = 0;
            $new_sub_reseller->save();

            $del_user = User::where('id',$request->id)->first();
            $del_user->delete();
            return redirect(route('admin.freeuser'))->with('success','Permission Changed');

        }

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

    public function free_user_add_cradit(Request $request)
    {
        $free_user_crd_ad = User::where('id',$request->add_crdt)->first();
        $free_user_crd_ad->cradit = $free_user_crd_ad->cradit + $request->cradit;
        $free_user_crd_ad->exp_date = Carbon::now()->addMonth($request->cradit);
        $free_user_crd_ad->save();
        return back()->with('success','Cradit Added Successfully');
    }

    public function bulk_user()
    {
        return view('admin.usernavigation.bulk-user');
    }

    public function bulk_user_save(Request $request)
    {
        $number = $request->number_of_user;
        for ($i=0;$i<$number;$i++)
        {

            $user = new User();
            $user->user_name = rand(000000,999999);
            $user->password = encrypt(rand(000000,999999));
            $user->upline_id = Auth::user()->id;
            $user->save();

        }

        return redirect(route('admin.freeuser'))->with('success','Bulk User Created Successfully');

    }

    public function add_credit()
    {
        $all_sub_adm = sub_administrator::all();
        return view('admin.usernavigation.add-credit',compact('all_sub_adm'));
    }

    public function sub_adminstrator_credit_add(Request $request)
    {
        $sub_admin = sub_administrator::where('id',$request->add_credit)->first();
        $sub_admin->cradit = $sub_admin->cradit +  $request->cradit;
        $sub_admin->exp_date = Carbon::now()->addMonth($request->cradit);
        $sub_admin->save();
        return back()->with('success','Credit Added Successfully');
    }

    public function reseller_credit()
    {
        $reseller = Reseller::paginate(15);
       return view('admin.usernavigation.reseller-add-credit',compact('reseller'));
    }

    public function reseller_credit_save(Request $request)
    {
        $resel_add_cred = Reseller::where('id',$request->add_credit)->first();
        $resel_add_cred->cradit = $resel_add_cred->cradit + $request->cradit;
        $resel_add_cred->exp_date = Carbon::now()->addMonth($request->cradit);
        $resel_add_cred->save();
        return back()->with('success','Credit Added Successfully');
    }

    public function subreseller_credit()
    {
        $subresller = Subreseller::paginate(15);
        return view('admin.usernavigation.subreseller-add-credit',compact('subresller'));
    }

    public function subreseller_credit_save(Request $request)
    {
        $sub_resl_save = Subreseller::where('id',$request->add_credit)->first();
        $sub_resl_save->cradit =$sub_resl_save->cradit + $request->cradit;
        $sub_resl_save->exp_date = Carbon::now()->addMonth($request->cradit);
        $sub_resl_save->save();
        return back()->with('success','Credit Added Successfully');
    }

    public function sub_ad_time_duration()
    {
        $time_sub_admin = User::paginate(15);
        return view('admin.usernavigation.sub-admin-time-duration',compact('time_sub_admin'));
    }

    public function fre_ad_time(Request $request)
    {
        $user = User::where('id',$request->add_time)->first();
        $user->exp_date = $request->exp_date;
        $user->save();
        return redirect(route('admin.time.duration'))->with('success','Time Added Successfully');
    }

    public function sub_ad_time_duration_select($id)
    {
        $sele_sub_admin = sub_administrator::where('id',$id)->first();
        return view('admin.usernavigation.select-sub-admin-time',compact('sele_sub_admin'));
    }

    public function sub_ad_time_duration_select_save(Request $request)
    {

        $time = $request->select_time;
        if ($time == 2)
        {
            $sub_admin_t = sub_administrator::where('id',$request->id)->first();
            $sub_admin_t->exp_date = Carbon::now()->addHour(1);
            $sub_admin_t->save();
            return redirect(route('admin.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 3)
        {
            $sub_admin_t = sub_administrator::where('id',$request->id)->first();
            $sub_admin_t->exp_date = Carbon::now()->addHour(2);
            $sub_admin_t->save();
            return redirect(route('admin.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 4)
        {
            $sub_admin_t = sub_administrator::where('id',$request->id)->first();
            $sub_admin_t->exp_date = Carbon::now()->addDays(5);
            $sub_admin_t->save();
            return redirect(route('admin.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 5)
        {
            $sub_admin_t = sub_administrator::where('id',$request->id)->first();
            $sub_admin_t->exp_date = Carbon::now()->addDays(10);
            $sub_admin_t->save();
            return redirect(route('admin.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 6)
        {
            $sub_admin_t = sub_administrator::where('id',$request->id)->first();
            $sub_admin_t->exp_date = Carbon::now()->addDays(30);
            $sub_admin_t->save();
            return redirect(route('admin.time.duration'))->with('success','Time Added Successfully');
        }
    }

    public function reseller_time_duration()
    {
        $time_reseller = Reseller::paginate(15);
        return view('admin.usernavigation.reseller-time-duration',compact('time_reseller'));
    }

    public function reseller_time_duration_select($id)
    {
        $select_reseller_time = Reseller::where('id',$id)->first();
        return view('admin.usernavigation.select-reseller-time',compact('select_reseller_time'));
    }

    public function reseller_time_duration_select_save(Request $request)
    {
        $time = $request->select_time;
        if ($time == 2)
        {
            $sub_reseller_t = Reseller::where('id',$request->id)->first();
            $sub_reseller_t->exp_date = Carbon::now()->addHour(1);
            $sub_reseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 3)
        {
            $sub_reseller_t = Reseller::where('id',$request->id)->first();
            $sub_reseller_t->exp_date = Carbon::now()->addHour(2);
            $sub_reseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 4)
        {
            $sub_reseller_t = Reseller::where('id',$request->id)->first();
            $sub_reseller_t->exp_date = Carbon::now()->addDays(5);
            $sub_reseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 5)
        {
            $sub_reseller_t = Reseller::where('id',$request->id)->first();
            $sub_reseller_t->exp_date = Carbon::now()->addDays(10);
            $sub_reseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 6)
        {
            $sub_reseller_t = Reseller::where('id',$request->id)->first();
            $sub_reseller_t->exp_date = Carbon::now()->addDays(30);
            $sub_reseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
    }

    public function subreseller_time_duration()
    {
        $subreseler = Subreseller::paginate(15);
        return view('admin.usernavigation.subreseller-time-duration',compact('subreseler'));
    }

    public function subreseller_time_duration_select($id)
    {
        $select_time_subreseler = Subreseller::where('id',$id)->first();
        return view('admin.usernavigation.select-subreseller-time-duration',compact('select_time_subreseler'));
    }

    public function subreseller_time_duration_select_save(Request $request)
    {
        $time = $request->select_time;
        if ($time == 2)
        {
            $subreseller_t = Subreseller::where('id',$request->id)->first();
            $subreseller_t->exp_date = Carbon::now()->addHour(1);
            $subreseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 3)
        {
            $subreseller_t = Subreseller::where('id',$request->id)->first();
            $subreseller_t->exp_date = Carbon::now()->addHour(2);
            $subreseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 4)
        {
            $subreseller_t = Subreseller::where('id',$request->id)->first();
            $subreseller_t->exp_date = Carbon::now()->addDays(5);
            $subreseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 5)
        {
            $subreseller_t = Subreseller::where('id',$request->id)->first();
            $subreseller_t->exp_date = Carbon::now()->addDays(10);
            $subreseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
        if ($time == 6)
        {
            $subreseller_t = Subreseller::where('id',$request->id)->first();
            $subreseller_t->exp_date = Carbon::now()->addDays(30);
            $subreseller_t->save();
            return redirect(route('admin.reseller.time.duration'))->with('success','Time Added Successfully');
        }
    }

    public function all_user()
    {
        $sub_ad = sub_administrator::paginate(15);
        $reseller = Reseller::paginate(15);
        $sub_reseller = Subreseller::paginate(15);
        return view('admin.usernavigation.all-user',compact('sub_ad','reseller','sub_reseller'));
    }

}
