@extends('layouts.admin')
@section('admin-content')


    <div class="row">
        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-users"></i></div>
                <div class="num" data-start="0" data-end="83" data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Registered users</h3>
                <p>so far in our blog, and our website.</p>
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-chart-bar"></i></div>
                <div class="num" data-start="0" data-end="135" data-postfix="" data-duration="1500" data-delay="600">0</div>

                <h3>Daily Visitors</h3>
                <p>this is the average value.</p>
            </div>

        </div>

        <div class="clear visible-xs"></div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-aqua">
                <div class="icon"><i class="entypo-mail"></i></div>
                <div class="num" data-start="0" data-end="23" data-postfix="" data-duration="1500" data-delay="1200">0</div>

                <h3>New Messages</h3>
                <p>messages per day.</p>
            </div>

        </div>

        <div class="col-sm-3 col-xs-6">

            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-rss"></i></div>
                <div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">0</div>

                <h3>Subscribers</h3>
                <p>on our site right now.</p>
            </div>

        </div>
    </div>

    <br />




    <br />

    <div class="row">



        <div class="col-sm-12">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">Latest Updated Profiles</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Activity</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Art Ramadani</td>
                        <td>CEO</td>
                        <td class="text-center"><span class="inlinebar">4,3,5,4,5,6</span></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Ylli Pylla</td>
                        <td>Font-end Developer</td>
                        <td class="text-center"><span class="inlinebar-2">1,3,4,5,3,5</span></td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Arlind Nushi</td>
                        <td>Co-founder</td>
                        <td class="text-center"><span class="inlinebar-3">5,3,2,5,4,5</span></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <br />

    @endsection