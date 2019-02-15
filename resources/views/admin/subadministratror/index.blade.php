@extends('layouts.admin')
@section('css')
    @endsection
@section('admin-content')



    <a   data-toggle="modal" data-target="#sub-administrator-create" class="btn btn-primary pull-left">
    <i class="entypo-plus"></i>
    Create New
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
                    <th>Credit</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($all_sub_adminitrator as $subad)
                <tr>
                    <td>{{$subad->name}}</td>
                    <td>{{$subad->user_name}}</td>
                    <td>{{$subad->cradit}}</td>
                    <td>
                    <a href="#" class="btn btn-default btn-sm btn-icon icon-left">
                        <i class="entypo-pencil"></i>
                        Edit
                    </a>

                    <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                        <i class="entypo-cancel"></i>
                        Delete
                    </a>

                    <a href="#" class="btn btn-info btn-sm btn-icon icon-left">
                        <i class="entypo-info"></i>
                        Profile
                    </a>
                    </td>
                </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade custom-width modalfate" id="sub-administrator-create">
        <div class="modal-dialog" style="width: 60%;">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Create New Sub-Administrator</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"  class="form-control fullname" placeholder="Enter Full name">
                                <p class="text-left fullnameerror" style="color: red">Please Enter Name !</p>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="" class="form-control username" placeholder="Enter User Name">
                                <p class="text-left usernameerror" style="color: red">Please Enter User Name !</p>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Credits</label>
                                <input type="number" name="" class="form-control cradit" placeholder="Enter Credits">
                                <p class="text-left craditerror" style="color: red">Please Enter Credits !</p>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control password" placeholder="Enter Password">
                                <p class="text-left passworderror" style="color: red">Please Enter Password !</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save_data" class="btn btn-info">Save</button>
                </div>
            </div>
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
                        url: "{{route('sub.administrator.create')}}",
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





            })




        })
    </script>
    @endsection
