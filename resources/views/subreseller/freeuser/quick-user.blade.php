@extends('layouts.subreseller')
@section('css')
@endsection
@section('subreseller-content')




    <div class="panel panel-primary">

        <div class="panel-heading">
            <div class="panel-title">Create Quick User</div>
        </div>

        <div class="panel-body">

            <form role="form" id="form1" action="{{route('subreseller.quieck.user.save')}}" method="post" class="validate">
                @csrf

                <div class="form-group">
                    <label class="control-label">User Name</label>

                    <input type="text" class="form-control" name="user_name" value="{{rand(000000,999999)}}" data-validate="email" placeholder="Enter User Name" readonly/>
                </div>

                <div class="form-group">
                    <label class="control-label">Password</label>

                    <input type="text" class="form-control" name="password" value="{{rand(000000,999999)}}" data-validate="maxlength[2]" placeholder="Enter Password" readonly/>
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn">back</button>
                </div>

            </form>

        </div>

    </div>
@endsection