@extends('layouts.admin')
@section('css')
@endsection
@section('admin-content')



    <a href="{{route('admin.credit')}}" class="btn btn-primary pull-left" >
        <i class="entypo-plus"></i>
        Sub Administrator
    </a>
    <a href="{{route('admin.credit.reseller')}}" class="btn btn-primary pull-left" style="margin-left: 10px">
        <i class="entypo-plus"></i>
        Reseller
    </a>
    <a href="{{route('admin.credit.subreseller.add')}}" class="btn btn-primary pull-left" style="margin-left: 10px">
        <i class="entypo-plus"></i>
        Sub Reseller
    </a>
    <div id="table-1_filter" class="dataTables_filter pull-right">
        <form action="{{route('admin.reseller.cradit.search')}}" method="post">
            @csrf
            <label>Search:
                <input type="search" class="" name="search" placeholder="" aria-controls="table-1">
            </label>
        </form>
    </div>


    <br />

    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Upline Name</th>
                    <th>Credit</th>
                    <th>Created date</th>
                    <th>User Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($reseller as $resl)
                    <tr>
                        <td>{{$resl->name}}</td>
                        <td>{{$resl->user_name}}</td>
                        <td>{{ $resl->pass_rep}}</td>
                        @if(!empty($resl->upline_id))
                            <td>{{$resl->admin->name}}</td>
                        @elseif(!empty($resl->administrator_id))
                            <td>{{$resl->administrator->name}}</td>
                        @else
                            <td>Not Set Yet</td>
                        @endif
                        <td>{{$resl->cradit}}</td>
                        <td>{{$resl->created_at}}</td>
                        @if($resl->is_block == 0)
                            <td><span class="label label-info">Active</span></td>
                        @else
                            <td><span class="label label-danger">Block</span></td>
                        @endif
                        <td>
                            <a href="{{route('admin.reseller.edit',$resl->id)}}" class="btn btn-default btn-sm btn-icon icon-left" >
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>

                            <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#reseller-delete{{$resl->id}}">
                                <i class="entypo-cancel"></i>
                                Delete
                            </a>
                            <a href="{{route('admin.reseller.chnageper',$resl->id)}}" class="btn btn-info btn-sm btn-icon icon-left">
                                <i class="entypo-info"></i>
                                Change Permision
                            </a>
                            @if($resl->is_block == 0)
                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-block{{$resl->id}}">
                                    <i class="entypo-cancel"></i>
                                    Block
                                </a>
                            @else
                                <a href="#" class="btn btn-danger btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-unblock{{$resl->id}}">
                                    <i class="entypo-cancel"></i>
                                    Unblock
                                </a>
                            @endif
                            <a href="#" class="btn btn-default btn-sm btn-icon icon-left" data-toggle="modal" data-target="#sub-subreseller-add-cradit{{$resl->id}}">
                                <i class="entypo-cancel"></i>
                                Add Cradit
                            </a>


                        </td>
                    </tr>



                    <div class="modal fade custom-width modalfate" id="reseller-delete{{$resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.reseller.delete')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Delete Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="delete_reseller" value="{{$resl->id}}">
                                        <h3 class="text-center">are you sure to delete <strong>{{$resl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-block{{$resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.reseller.block')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Block Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="block_reseller" value="{{$resl->id}}">
                                        <h3 class="text-center">are you sure to block <strong>{{$resl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Block</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-unblock{{$resl->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.reseller.unblock')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Unblock Reseller</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="unblock_reseller" value="{{$resl->id}}">
                                        <h3 class="text-center">are you sure to unblock <strong>{{$resl->user_name}}</strong> ?</h3>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="" class="btn btn-info">Unblock</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade custom-width modalfate" id="sub-subreseller-add-cradit{{$resl->id}}">
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
                                            <input type="hidden" name="add_crdt" value="{{$resl->id}}">
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


    <div class="modal fade custom-width modalfate" id="reseller_create">
        <div class="modal-dialog" style="width: 60%;">
            <form action="{{route('admin.reseller.create')}}" method="post">
                @csrf
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Create Reseller</h4>
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
