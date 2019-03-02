@extends('layouts.admin')
@section('css')
@endsection
@section('admin-content')



    <a href="{{route('admin.time.duration')}}" class="btn btn-primary pull-left" >
        <i class="entypo-plus"></i>
        Sub Administrator
    </a>
    <a href="{{route('admin.reseller.time.duration')}}" class="btn btn-primary pull-left" style="margin-left: 10px">
        <i class="entypo-plus"></i>
        Reseller
    </a>
    <a href="{{route('admin.subreseller.time.duration')}}" class="btn btn-primary pull-left" style="margin-left: 10px">
        <i class="entypo-plus"></i>
        Sub Reseller
    </a>
    <div id="table-1_filter" class="dataTables_filter pull-right">
        <form action="{{route('admin.reseller.time.search')}}" method="post">
            @csrf
            <label>Search:
                <input type="search" class="" name="search" placeholder="" aria-controls="table-1">
            </label>
        </form>
    </div>


    <br />

    <div class="row">

        <div class="col-md-12">
            <div class="panel-heading">
                <div class="panel-title">Reseller</div>
            </div>
            <table class="table table-bordered responsive">
                <thead>
                <tr>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Upline</th>
                    <th>Credit</th>
                    <th>User Status</th>
                    <th>Exp. Date</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($time_reseller as $alsuba)
                    <tr>
                        <td>{{$alsuba->user_name}}</td>
                        <td>{{ decrypt($alsuba->password)}}</td>
                        <td>{{$alsuba->upline_id}}</td>
                        <td>{{$alsuba->cradit}}</td>
                        @if($alsuba->is_block == 0)
                            <td><span class="label label-info">Active</span></td>
                        @else
                            <td><span class="label label-danger">Block</span></td>
                        @endif
                        <td>{{$alsuba->exp_date}}</td>
                        <td>

                            <a href="{{route('reseller.timedur',$alsuba->id)}}" class="btn btn-default btn-sm btn-icon icon-left" >
                                <i class="entypo-cancel"></i>
                                Add Time Duration
                            </a>


                        </td>
                    </tr>






                    <div class="modal fade custom-width modalfate" id="sub-administrator-add-credit{{$alsuba->id}}">
                        <div class="modal-dialog" style="width: 60%;">
                            <form action="{{route('admin.subadmintator.credit.add')}}" method="post">
                                @csrf
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Add Credit</h4>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="add_credit" value="{{$alsuba->id}}">
                                        <input type="number" class="form-control" name="cradit">
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
