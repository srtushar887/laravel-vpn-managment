@extends('layouts.admin')
@section('css')
@endsection
@section('admin-content')




    <div class="panel panel-primary">

        <div class="panel-heading">
            <div class="panel-title">Create Sub-Administrator</div>
        </div>

        <div class="panel-body">

            <form role="form" id="form1" action="{{route('sub.administrator.chnage.permision.save')}}" method="post" class="validate">
                @csrf
                <div class="form-group">
                    <label class="control-label">Select Permission</label>
                    <input type="hidden" name="id" value="{{$users_data->id}}">
                    <input type="hidden" name="name" value="{{$users_data->name}}">
                    <input type="hidden" name="user_name" value="{{$users_data->user_name}}">
                    <input type="hidden" name="cradit" value="{{$users_data->cradit}}">
                    <input type="hidden" name="password" value="{{decrypt($users_data->password)}}">
                    <select class="form-control" name="chnage_per">
                        <option value="">select any</option>
                        <option value="2">Reseller</option>
                        <option value="3">Sub Reseller</option>
                    </select>
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="reset" class="btn">back</button>
                </div>

            </form>

        </div>

    </div>
@endsection