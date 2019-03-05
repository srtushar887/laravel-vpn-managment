@extends('layouts.reseller')
@section('css')
@endsection
@section('reseller-content')




    <div class="panel panel-primary">

        <div class="panel-heading">
            <div class="panel-title">Create Free User</div>
        </div>

        <div class="panel-body">

            <form role="form" id="form1" action="{{route('reseller.free.user.store')}}" method="post" class="validate">
                @csrf
                <div class="form-group">
                    <label class="control-label">Full Name</label>

                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Enter Full name" />
                </div>

                <div class="form-group">
                    <label class="control-label">User Name</label>

                    <input type="text" class="form-control" name="user_name" data-validate="email" placeholder="Enter User Name" />
                </div>

                <div class="form-group">
                    <label class="control-label">Credits</label>

                    <input type="number" class="form-control" name="cradit" data-validate="number,minlength[4]" placeholder="Enter Credits" />
                </div>

                <div class="form-group">
                    <label class="control-label">Password</label>

                    <input type="text" class="form-control" name="password" data-validate="maxlength[2]" placeholder="Enter Password" />
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn">back</button>
                </div>

            </form>

        </div>

    </div>
@endsection