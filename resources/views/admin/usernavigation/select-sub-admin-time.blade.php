@extends('layouts.admin')
@section('css')
@endsection
@section('admin-content')




    <div class="panel panel-primary">

        <div class="panel-heading">
            <div class="panel-title">Select Tiem Duration</div>
        </div>

        <div class="panel-body">

            <form role="form" id="form1" action="{{route('subadmin.time.save')}}" method="post" class="validate">
                @csrf
                <div class="form-group">
                    <label class="control-label">Select Time</label>
                    <input type="hidden" name="id" value="{{$sele_sub_admin->id}}">
                    <select class="form-control" name="select_time">
                        <option value="">select any</option>
                        <option value="2">1 Hour</option>
                        <option value="3">2 Hour</option>
                        <option value="4">5 Day</option>
                        <option value="5">10 Day</option>
                        <option value="6">30 Day</option>
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