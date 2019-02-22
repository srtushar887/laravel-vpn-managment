@extends('layouts.admin')
@section('css')
@endsection
@section('admin-content')




    <div class="panel panel-primary">

        <div class="panel-heading">
            <div class="panel-title">Create Bulk User</div>
        </div>

        <div class="panel-body">

            <form role="form" id="form1" action="{{route('bulk.user.store')}}" method="post" class="validate">
                @csrf
                <div class="form-group">
                    <label class="control-label">Enter Number Of User</label>

                    <input type="text" class="form-control" name="number_of_user" data-validate="required" data-message-required="This is custom message for required field." placeholder="Enter Full name" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="reset" class="btn">back</button>
                </div>

            </form>

        </div>

    </div>
@endsection