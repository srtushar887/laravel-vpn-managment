@extends('layouts.admin')
@section('css')
@endsection
@section('admin-content')



    <a href="{{route('create.subadmin')}}" class="btn btn-primary pull-left">
        <i class="entypo-plus"></i>
        Create Sub Administrator
    </a>
    <a href="javascript: fnClickAddRow();" class="btn btn-primary pull-right">
        <i class="entypo-plus"></i>
        Search
    </a>


    <br />

    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Upline</th>
                    <th>Credit</th>
                    <th>Created Date</th>
                    <th>User Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($sub_ad as $al_sub_ad)
                    <tr>
                        <td>{{$al_sub_ad->name}}</td>
                        <td>{{$al_sub_ad->user_name}}</td>
                        <td>{{ decrypt($al_sub_ad->password)}}</td>
                        <td>{{$al_sub_ad->upline_id}}</td>
                        <td>{{$al_sub_ad->cradit}}</td>
                        <td>{{$al_sub_ad->created_at}}</td>
                        @if($al_sub_ad->is_active == 0)
                            <td><span class="label label-info">Active</span></td>
                        @else
                            <td><span class="label label-danger">Block</span></td>
                        @endif
                        <td>
                            <a href="{{route('sub.admin.edit',$al_sub_ad->id)}}" class="btn btn-default btn-sm btn-icon icon-left" >
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>

                            <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-administrator-delete{{$al_sub_ad->id}}">
                                <i class="entypo-cancel"></i>
                                Delete
                            </a>
                            <a href="{{route('admin.subadminis.chnageper',$al_sub_ad->id)}}" class="btn btn-info btn-sm btn-icon icon-left">
                                <i class="entypo-info"></i>
                                Change Permision
                            </a>
                            @if($al_sub_ad->is_active == 0)
                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-administrator-block{{$al_sub_ad->id}}">
                                    <i class="entypo-cancel"></i>
                                    Block
                                </a>
                            @else

                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-administrator-unblock{{$al_sub_ad->id}}">
                                    <i class="entypo-cancel"></i>
                                    Unblock
                                </a>
                            @endif
                            <a href="#" class="btn btn-default btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-administrator-add-cradit{{$al_sub_ad->id}}">
                                <i class="entypo-cancel"></i>
                                Add Cradit
                            </a>

                        </td>
                    </tr>


                    <div class="modal fade custom-width modalfate" id="sub-administrator-edit{{$al_sub_ad->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('sub.administrator.update')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Update Sub-Administrator</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="hidden" name="edit_sub_ad" value="{{$al_sub_ad->id}}">
                                                    <input type="text"  class="form-control fullname" name="name" value="{{$al_sub_ad->name}}" placeholder="Enter Full name">
                                                    <p class="text-left fullnameerror" style="color: red">Please Enter Name !</p>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" name="user_name" class="form-control username" value="{{$al_sub_ad->user_name}}" placeholder="Enter User Name">
                                                    <p class="text-left usernameerror" style="color: red">Please Enter User Name !</p>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Credits</label>
                                                    <input type="number" name="cradit" class="form-control cradit" value="{{$al_sub_ad->cradit}}" placeholder="Enter Credits">
                                                    <p class="text-left craditerror" style="color: red">Please Enter Credits !</p>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" name="password" class="form-control password" value="{{decrypt($al_sub_ad->password)}}" placeholder="Enter Password">
                                                    <p class="text-left passworderror" style="color: red">Please Enter Password !</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-administrator-delete{{$al_sub_ad->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('sub.administrator.delete')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Delete Sub-Administrator</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="delete_sub_ad" value="{{$al_sub_ad->id}}">
                                        <h3 class="text-center">are you sure to delete <strong>{{$al_sub_ad->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-administrator-block{{$al_sub_ad->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.subadminis.block')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Block Sub-Administrator</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="block_sub_ad" value="{{$al_sub_ad->id}}">
                                        <h3 class="text-center">are you sure to block <strong>{{$al_sub_ad->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Block</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-administrator-unblock{{$al_sub_ad->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.subadminis.unblock')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Unblock Sub-Administrator</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="unblock_sub_ad" value="{{$al_sub_ad->id}}">
                                        <h3 class="text-center">are you sure to unblock <strong>{{$al_sub_ad->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Unblock</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-administrator-add-cradit{{$al_sub_ad->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('sub.administrator.add.credit.bal')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Add Cradit</h4>
                                    </div>

                                    <div class="modal-body">


                                        <div class="form-group">
                                            <label>Cradit</label>
                                            <input type="hidden" name="add_crdt" value="{{$al_sub_ad->id}}">
                                            <input type="text"  class="form-control fullname" name="cradit"  placeholder="Enter Cradit">
                                        </div>



                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade custom-width modalfate" id="sub-administrator-create">
        <div class="modal-dialog" style="width: 60%;">
            <form action="{{route('sub.administrator.create')}}" method="post">
                @csrf
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Create Sub-Administrator</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text"  class="form-control fullname" name="name" placeholder="Enter Full name">
                                    {{--<p class="text-left fullnameerror" style="color: red">Please Enter Name !</p>--}}
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="user_name" class="form-control username"  placeholder="Enter User Name">
                                    {{--<p class="text-left usernameerror" style="color: red">Please Enter User Name !</p>--}}
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Credits</label>
                                    <input type="number" name="cradit" class="form-control cradit" placeholder="Enter Credits">
                                    {{--<p class="text-left craditerror" style="color: red">Please Enter Credits !</p>--}}
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control password" placeholder="Enter Password">
                                    {{--<p class="text-left passworderror" style="color: red">Please Enter Password !</p>--}}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="" class="btn btn-info">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>










    <a href="{{route('craete.reseller')}}" class="btn btn-primary pull-left">
        <i class="entypo-plus"></i>
        Create Reseller
    </a>
    <a href="javascript: fnClickAddRow();" class="btn btn-primary pull-right">
        <i class="entypo-plus"></i>
        Search
    </a>


    <br />

    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Upline</th>
                    <th>Credit</th>
                    <th>Created date</th>
                    <th>User Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($reseller as $al_resl)
                    <tr>
                        <td>{{$al_resl->name}}</td>
                        <td>{{$al_resl->user_name}}</td>
                        <td>{{ decrypt($al_resl->password)}}</td>
                        <td>{{$al_resl->upline_id}}</td>
                        <td>{{$al_resl->cradit}}</td>
                        <td>{{$al_resl->created_at}}</td>
                        @if($al_resl->is_block == 0)
                            <td><span class="label label-info">Active</span></td>
                        @else
                            <td><span class="label label-danger">Block</span></td>
                        @endif
                        <td>
                            <a href="{{route('reseller.edit',$al_resl->id)}}" class="btn btn-default btn-sm btn-icon icon-left" >
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>

                            <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#reseller-delete{{$al_resl->id}}">
                                <i class="entypo-cancel"></i>
                                Delete
                            </a>
                            <a href="{{route('admin.reseller.chnageper',$al_resl->id)}}" class="btn btn-info btn-sm btn-icon icon-left">
                                <i class="entypo-info"></i>
                                Change Permision
                            </a>
                            @if($al_resl->is_block == 0)
                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-block{{$al_resl->id}}">
                                    <i class="entypo-cancel"></i>
                                    Block
                                </a>
                            @else
                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-unblock{{$al_resl->id}}">
                                    <i class="entypo-cancel"></i>
                                    Unblock
                                </a>
                            @endif
                            <a href="#" class="btn btn-default btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-add-cradit{{$al_resl->id}}">
                                <i class="entypo-cancel"></i>
                                Add Cradit
                            </a>


                        </td>
                    </tr>


                    <div class="modal fade custom-width modalfate" id="reseller-edit{{$al_resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.reseller.update')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Update Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="hidden" name="edit_res" value="{{$al_resl->id}}">
                                                    <input type="text"  class="form-control fullname" name="name" value="{{$al_resl->name}}" placeholder="Enter Full name">
                                                    {{--<p class="text-left fullnameerror" style="color: red">Please Enter Name !</p>--}}
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" name="user_name" class="form-control username" value="{{$al_resl->user_name}}" placeholder="Enter User Name">
                                                    {{--<p class="text-left usernameerror" style="color: red">Please Enter User Name !</p>--}}
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Credits</label>
                                                    <input type="number" name="cradit" class="form-control cradit" value="{{$al_resl->cradit}}" placeholder="Enter Credits">
                                                    {{--<p class="text-left craditerror" style="color: red">Please Enter Credits !</p>--}}
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" name="password" class="form-control password" value="{{decrypt($al_resl->password)}}" placeholder="Enter Password">
                                                    {{--<p class="text-left passworderror" style="color: red">Please Enter Password !</p>--}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="reseller-delete{{$al_resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.reseller.delete')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Delete Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="delete_reseller" value="{{$al_resl->id}}">
                                        <h3 class="text-center">are you sure to delete <strong>{{$al_resl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-block{{$al_resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.reseller.block')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Block Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="block_reseller" value="{{$al_resl->id}}">
                                        <h3 class="text-center">are you sure to block <strong>{{$al_resl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Block</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-unblock{{$al_resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.reseller.unblock')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Unblock Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="unblock_reseller" value="{{$al_resl->id}}">
                                        <h3 class="text-center">are you sure to unblock <strong>{{$al_resl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Unblock</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-add-cradit{{$al_resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('reseller.add.credit.bal')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Add Cradit</h4>
                                    </div>

                                    <div class="modal-body">


                                        <div class="form-group">
                                            <label>Cradit</label>
                                            <input type="hidden" name="add_crdt" value="{{$al_resl->id}}">
                                            <input type="text"  class="form-control fullname" name="cradit"  placeholder="Enter Cradit">
                                        </div>



                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>









    <a href="{{route('create.subreseller')}}" class="btn btn-primary pull-left">
        <i class="entypo-plus"></i>
        Create Sub Reseller
    </a>
    <a href="javascript: fnClickAddRow();" class="btn btn-primary pull-right">
        <i class="entypo-plus"></i>
        Search
    </a>


    <br />

    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Upline</th>
                    <th>Credit</th>
                    <th>Created Date</th>
                    <th>User Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($sub_reseller as $alsubresl)
                    <tr>
                        <td>{{$alsubresl->name}}</td>
                        <td>{{$alsubresl->user_name}}</td>
                        <td>{{ decrypt($alsubresl->password)}}</td>
                        <td>{{$alsubresl->upline_id}}</td>
                        <td>{{$alsubresl->cradit}}</td>
                        <td>{{$alsubresl->created_at}}</td>
                        @if($alsubresl->is_block == 0)
                            <td><span class="label label-info">Active</span></td>
                        @else
                            <td><span class="label label-danger">Block</span></td>
                        @endif
                        <td>
                            <a href="{{route('sub.reseller.edit',$alsubresl->id)}}" class="btn btn-default btn-sm btn-icon icon-left">
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>

                            <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#subreseller-delete{{$alsubresl->id}}">
                                <i class="entypo-cancel"></i>
                                Delete
                            </a>

                            <a href="{{route('admin.subreseller.chnageper',$alsubresl->id)}}" class="btn btn-info btn-sm btn-icon icon-left">
                                <i class="entypo-info"></i>
                                Change Permision
                            </a>
                            @if($alsubresl->is_block == 0)
                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-block{{$alsubresl->id}}">
                                    <i class="entypo-cancel"></i>
                                    Block
                                </a>
                            @else
                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-unblock{{$alsubresl->id}}">
                                    <i class="entypo-cancel"></i>
                                    Unblock
                                </a>
                            @endif
                            <a href="#" class="btn btn-default btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-reseller-add-cradit{{$alsubresl->id}}">
                                <i class="entypo-cancel"></i>
                                Add Cradit
                            </a>


                        </td>
                    </tr>


                    <div class="modal fade custom-width modalfate" id="subreseller-edit{{$alsubresl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.subreseller.update')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Update Sub-Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="hidden" name="edit_subres" value="{{$alsubresl->id}}">
                                                    <input type="text"  class="form-control fullname" name="name" value="{{$alsubresl->name}}" placeholder="Enter Full name">
                                                    {{--<p class="text-left fullnameerror" style="color: red">Please Enter Name !</p>--}}
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" name="user_name" class="form-control username" value="{{$alsubresl->user_name}}" placeholder="Enter User Name">
                                                    {{--<p class="text-left usernameerror" style="color: red">Please Enter User Name !</p>--}}
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Credits</label>
                                                    <input type="number" name="cradit" class="form-control cradit" value="{{$alsubresl->cradit}}" placeholder="Enter Credits">
                                                    {{--<p class="text-left craditerror" style="color: red">Please Enter Credits !</p>--}}
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" name="password" class="form-control password" value="{{decrypt($alsubresl->password)}}" placeholder="Enter Password">
                                                    {{--<p class="text-left passworderror" style="color: red">Please Enter Password !</p>--}}
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="subreseller-delete{{$alsubresl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.subreseller.delete')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Delete Sub-Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="delete_subreseller" value="{{$alsubresl->id}}">
                                        <h3 class="text-center">are you sure to delete <strong>{{$alsubresl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-block{{$alsubresl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.subreseller.block')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Block Sub-Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="block_subreseller" value="{{$alsubresl->id}}">
                                        <h3 class="text-center">are you sure to block <strong>{{$alsubresl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Block</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-unblock{{$alsubresl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.subreseller.unblock')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Unblock Sub-Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="unblock_subreseller" value="{{$alsubresl->id}}">
                                        <h3 class="text-center">are you sure to unbblock <strong>{{$alsubresl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Unblock</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-reseller-add-cradit{{$alsubresl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('subreseller.add.credit.bal')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Add Cradit</h4>
                                    </div>

                                    <div class="modal-body">


                                        <div class="form-group">
                                            <label>Cradit</label>
                                            <input type="hidden" name="add_crdt" value="{{$alsubresl->id}}">
                                            <input type="text"  class="form-control fullname" name="cradit"  placeholder="Enter Cradit">
                                        </div>



                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                @endforeach

                </tbody>
            </table>
        </div>
    </div>







@endsection
@section('js')


    <script>
        $(document).ready(function () {
            $('.fullnameerror').hide();
            $('.usernameerror').hide();
            $('.craditerror').hide();
            $('.passworderror').hide();


            $('#save_data').click(function () {
                var name = $('.fullname').val();
                var username = $('.username').val();
                var cradit = $('.cradit').val();
                var password = $('.password').val();
                if (name.length == 0)
                {
                    $('.fullnameerror').show();
                }else {
                    $('.fullnameerror').hide();
                }
                if (username.length == 0)
                {
                    $('.usernameerror').show();
                }else {
                    $('.usernameerror').hide();
                }
                if (cradit.length == 0)
                {
                    $('.craditerror').show();
                }else {
                    $('.craditerror').hide();
                }
                if (password.length == 0)
                {
                    $('.passworderror').show();
                }else {
                    $('.passworderror').hide();
                }

                if (name.length != 0 && username.length != 0 && cradit.length != 0 && password.length != 0)
                {
                    $.ajax({
                        type : "POST",
                        url: "",
                        data : {
                            '_token' : "{{csrf_token()}}",
                            'name':name,
                            'username':username,
                            'cradit':cradit,
                            'password':password,
                        },
                        success:function(data){
                            console.log(data);
                            $('.fullname').empty();
                            $('.username').empty();
                            $('.cradit').empty();
                            $('.password').empty();
                            $('#sub-administrator-create').modal('hide');
                            swal('Sub-Aministrator Saved Successfully','','success');
                        }
                    });
                }





            });








        })
    </script>
@endsection
