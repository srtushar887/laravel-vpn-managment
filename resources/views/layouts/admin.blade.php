<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="{{asset('assets/admin/')}}/images/favicon.ico">

    <title>Neon | Dashboard</title>

    <link rel="stylesheet" href="{{asset('assets/admin/')}}/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/neon-core.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/neon-theme.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/neon-forms.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/custom.css">
    @yield('css')
    <script src="{{asset('assets/admin/')}}/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="{{asset('assets/admin/')}}/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="index.html">
                        <img src="{{asset('assets/admin/')}}/images/logo@2x.png" width="120" alt="" />
                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>


            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

                <li>
                    <a href="{{route('admin.dashboard')}}" >
                        <i class="entypo-gauge"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>



                <li>
                    <a href="{{route('admin.sub.administratio')}}" >
                        <i class="entypo-monitor"></i>
                        <span class="title">Sub Administrator</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.reseller')}}" >
                        <i class="entypo-monitor"></i>
                        <span class="title">Reseller</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.sub.reseller')}}" >
                        <i class="entypo-monitor"></i>
                        <span class="title">Sub-ReSeller</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.freeuser')}}" >
                        <i class="entypo-monitor"></i>
                        <span class="title">Add VPN User</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.create.quick.user')}}" >
                        <i class="entypo-monitor"></i>
                        <span class="title">Create Quick User</span>
                    </a>
                </li>



                {{--<li>--}}
                    {{--<a href="{{route('admin.all.user')}}" >--}}
                        {{--<i class="entypo-monitor"></i>--}}
                        {{--<span class="title">All User</span>--}}
                    {{--</a>--}}
                {{--</li>--}}

                <li>
                    <a href="{{route('admin.credit')}}" >
                        <i class="entypo-monitor"></i>
                        <span class="title">Add Credit</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.time.duration')}}" >
                        <i class="entypo-monitor"></i>
                        <span class="title">Add Time Duration</span>
                    </a>
                </li>

            </ul>

        </div>

    </div>

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">

                <ul class="user-info pull-left pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
                        @if(request()->path() == 'admin/sub-administrator')
                        <h2>Sub-Administrator</h2>
                            @endif
                        @if(request()->path() == 'admin/sub-administrator-search')
                            <h2>Sub-Administrator</h2>
                        @endif
                        {{--@if(request()->path() == 'admin/create-sub-administrator')--}}
                        {{--<h2>Create Sub-Administrator</h2>--}}
                        {{--@endif--}}

                        {{--@if(request()->path() == 'admin/sub-administrator-edit/')--}}
                            {{--<h2>Update Sub-Administrator</h2>--}}
                        {{--@endif--}}
                        @if(request()->path() == 'admin/reseller')
                            <h2>Reseller</h2>
                        @endif
                        @if(request()->path() == 'admin/sub-reseller')
                            <h2>Sub-Reseller</h2>
                        @endif


                    </li>

                </ul>



            </div>
            <div class="col-md-6 col-sm-8 clearfix">

                <ul class="user-info pull-right pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('assets/admin/')}}/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
                            {{Auth::user('admin')->name}}
                        </a>

                        <ul class="dropdown-menu">

                            <!-- Reverse Caret -->
                            <li class="caret"></li>

                            <!-- Profile sub-links -->
                            <li>
                                <a href="extra-timeline.html">
                                    <i class="entypo-user"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="extra-timeline.html">
                                    <i class="entypo-user"></i>
                                    Change Passsword
                                </a>
                            </li>





                            <li>
                                <a href="{{route('admin.logout')}}">
                                    <i class="entypo-logout right"></i>
                                    Log Out
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>



            </div>


            <!-- Raw Links -->
            {{--<div class="col-md-6 col-sm-4 clearfix hidden-xs">--}}

                {{--<ul class="list-inline links-list pull-right">--}}



                    {{--<li class="sep"></li>--}}

                    {{--<li>--}}
                        {{--<a href="{{route('admin.logout')}}">--}}
                            {{--Log Out <i class="entypo-logout right"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}

            {{--</div>--}}

        </div>

        <hr />


        {{--<script type="text/javascript">--}}
            {{--jQuery(document).ready(function($)--}}
            {{--{--}}
                {{--// Sample Toastr Notification--}}
                {{--// setTimeout(function()--}}
                {{--// {--}}
                {{--//     var opts = {--}}
                {{--//         "closeButton": true,--}}
                {{--//         "debug": false,--}}
                {{--//         "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",--}}
                {{--//         "toastClass": "black",--}}
                {{--//         "onclick": null,--}}
                {{--//         "showDuration": "300",--}}
                {{--//         "hideDuration": "1000",--}}
                {{--//         "timeOut": "5000",--}}
                {{--//         "extendedTimeOut": "1000",--}}
                {{--//         "showEasing": "swing",--}}
                {{--//         "hideEasing": "linear",--}}
                {{--//         "showMethod": "fadeIn",--}}
                {{--//         "hideMethod": "fadeOut"--}}
                {{--//     };--}}
                {{--//--}}
                {{--//     toastr.success("You have been awarded with 1 year free subscription. Enjoy it!", "Account Subcription Updated", opts);--}}
                {{--// }, 3000);--}}


                {{--// Sparkline Charts--}}
                {{--$('.inlinebar').sparkline('html', {type: 'bar', barColor: '#ff6264'} );--}}
                {{--$('.inlinebar-2').sparkline('html', {type: 'bar', barColor: '#445982'} );--}}
                {{--$('.inlinebar-3').sparkline('html', {type: 'bar', barColor: '#00b19d'} );--}}
                {{--$('.bar').sparkline([ [1,4], [2, 3], [3, 2], [4, 1] ], { type: 'bar' });--}}
                {{--$('.pie').sparkline('html', {type: 'pie',borderWidth: 0, sliceColors: ['#3d4554', '#ee4749','#00b19d']});--}}
                {{--$('.linechart').sparkline();--}}
                {{--$('.pageviews').sparkline('html', {type: 'bar', height: '30px', barColor: '#ff6264'} );--}}
                {{--$('.uniquevisitors').sparkline('html', {type: 'bar', height: '30px', barColor: '#00b19d'} );--}}


                {{--$(".monthly-sales").sparkline([1,2,3,5,6,7,2,3,3,4,3,5,7,2,4,3,5,4,5,6,3,2], {--}}
                    {{--type: 'bar',--}}
                    {{--barColor: '#485671',--}}
                    {{--height: '80px',--}}
                    {{--barWidth: 10,--}}
                    {{--barSpacing: 2--}}
                {{--});--}}


                {{--// JVector Maps--}}
                {{--var map = $("#map");--}}

                {{--map.vectorMap({--}}
                    {{--map: 'europe_merc_en',--}}
                    {{--zoomMin: '3',--}}
                    {{--backgroundColor: '#383f47',--}}
                    {{--focusOn: { x: 0.5, y: 0.8, scale: 3 }--}}
                {{--});--}}



                {{--// Line Charts--}}
                {{--var line_chart_demo = $("#line-chart-demo");--}}

                {{--var line_chart = Morris.Line({--}}
                    {{--element: 'line-chart-demo',--}}
                    {{--data: [--}}
                        {{--{ y: '2006', a: 100, b: 90 },--}}
                        {{--{ y: '2007', a: 75,  b: 65 },--}}
                        {{--{ y: '2008', a: 50,  b: 40 },--}}
                        {{--{ y: '2009', a: 75,  b: 65 },--}}
                        {{--{ y: '2010', a: 50,  b: 40 },--}}
                        {{--{ y: '2011', a: 75,  b: 65 },--}}
                        {{--{ y: '2012', a: 100, b: 90 }--}}
                    {{--],--}}
                    {{--xkey: 'y',--}}
                    {{--ykeys: ['a', 'b'],--}}
                    {{--labels: ['October 2013', 'November 2013'],--}}
                    {{--redraw: true--}}
                {{--});--}}

                {{--line_chart_demo.parent().attr('style', '');--}}


                {{--// Donut Chart--}}
                {{--var donut_chart_demo = $("#donut-chart-demo");--}}

                {{--donut_chart_demo.parent().show();--}}

                {{--var donut_chart = Morris.Donut({--}}
                    {{--element: 'donut-chart-demo',--}}
                    {{--data: [--}}
                        {{--{label: "Download Sales", value: getRandomInt(10,50)},--}}
                        {{--{label: "In-Store Sales", value: getRandomInt(10,50)},--}}
                        {{--{label: "Mail-Order Sales", value: getRandomInt(10,50)}--}}
                    {{--],--}}
                    {{--colors: ['#707f9b', '#455064', '#242d3c']--}}
                {{--});--}}

                {{--donut_chart_demo.parent().attr('style', '');--}}


                {{--// Area Chart--}}
                {{--var area_chart_demo = $("#area-chart-demo");--}}

                {{--area_chart_demo.parent().show();--}}

                {{--var area_chart = Morris.Area({--}}
                    {{--element: 'area-chart-demo',--}}
                    {{--data: [--}}
                        {{--{ y: '2006', a: 100, b: 90 },--}}
                        {{--{ y: '2007', a: 75,  b: 65 },--}}
                        {{--{ y: '2008', a: 50,  b: 40 },--}}
                        {{--{ y: '2009', a: 75,  b: 65 },--}}
                        {{--{ y: '2010', a: 50,  b: 40 },--}}
                        {{--{ y: '2011', a: 75,  b: 65 },--}}
                        {{--{ y: '2012', a: 100, b: 90 }--}}
                    {{--],--}}
                    {{--xkey: 'y',--}}
                    {{--ykeys: ['a', 'b'],--}}
                    {{--labels: ['Series A', 'Series B'],--}}
                    {{--lineColors: ['#303641', '#576277']--}}
                {{--});--}}

                {{--area_chart_demo.parent().attr('style', '');--}}




                {{--// Rickshaw--}}
                {{--var seriesData = [ [], [] ];--}}

                {{--var random = new Rickshaw.Fixtures.RandomData(50);--}}

                {{--for (var i = 0; i < 50; i++)--}}
                {{--{--}}
                    {{--random.addData(seriesData);--}}
                {{--}--}}

                {{--var graph = new Rickshaw.Graph( {--}}
                    {{--element: document.getElementById("rickshaw-chart-demo"),--}}
                    {{--height: 193,--}}
                    {{--renderer: 'area',--}}
                    {{--stroke: false,--}}
                    {{--preserve: true,--}}
                    {{--series: [{--}}
                        {{--color: '#73c8ff',--}}
                        {{--data: seriesData[0],--}}
                        {{--name: 'Upload'--}}
                    {{--}, {--}}
                        {{--color: '#e0f2ff',--}}
                        {{--data: seriesData[1],--}}
                        {{--name: 'Download'--}}
                    {{--}--}}
                    {{--]--}}
                {{--} );--}}

                {{--graph.render();--}}

                {{--var hoverDetail = new Rickshaw.Graph.HoverDetail( {--}}
                    {{--graph: graph,--}}
                    {{--xFormatter: function(x) {--}}
                        {{--return new Date(x * 1000).toString();--}}
                    {{--}--}}
                {{--} );--}}

                {{--var legend = new Rickshaw.Graph.Legend( {--}}
                    {{--graph: graph,--}}
                    {{--element: document.getElementById('rickshaw-legend')--}}
                {{--} );--}}

                {{--var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {--}}
                    {{--graph: graph,--}}
                    {{--legend: legend--}}
                {{--} );--}}

                {{--setInterval( function() {--}}
                    {{--random.removeData(seriesData);--}}
                    {{--random.addData(seriesData);--}}
                    {{--graph.update();--}}

                {{--}, 500 );--}}
            {{--});--}}


            {{--function getRandomInt(min, max)--}}
            {{--{--}}
                {{--return Math.floor(Math.random() * (max - min + 1)) + min;--}}
            {{--}--}}
        {{--</script>--}}

@yield('admin-content')

        <script type="text/javascript">
            // Code used to add Todo Tasks
            jQuery(document).ready(function($)
            {
                var $todo_tasks = $("#todo_tasks");

                $todo_tasks.find('input[type="text"]').on('keydown', function(ev)
                {
                    if(ev.keyCode == 13)
                    {
                        ev.preventDefault();

                        if($.trim($(this).val()).length)
                        {
                            var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white"><input type="checkbox" /><label>'+$(this).val()+'</label></div></li>');
                            $(this).val('');

                            $todo_entry.appendTo($todo_tasks.find('.todo-list'));
                            $todo_entry.hide().slideDown('fast');
                            replaceCheckboxes();
                        }
                    }
                });
            });
        </script>

        <div class="row">



            <div class="col-sm-9">

                <script type="text/javascript">
                    jQuery(document).ready(function($)
                    {
                        var map = $("#map-2");

                        map.vectorMap({
                            map: 'europe_merc_en',
                            zoomMin: '3',
                            backgroundColor: '#383f47',
                            focusOn: { x: 0.5, y: 0.8, scale: 3 }
                        });
                    });
                </script>



            </div>

        </div>

        <!-- Footer -->
        {{--<footer class="main" style="margin-top: 120px">--}}

            {{--&copy; 2019 Developed by <strong>SR Tusher</strong>--}}

        {{--</footer>--}}
    </div>


    <div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">

        <div class="chat-inner">


            <h2 class="chat-header">
                <a href="#" class="chat-close"><i class="entypo-cancel"></i></a>

                <i class="entypo-users"></i>
                Chat
                <span class="badge badge-success is-hidden">0</span>
            </h2>


            <div class="chat-group" id="group-1">
                <strong>Favorites</strong>

                <a href="#" id="sample-user-123" data-conversation-history="#sample_history"><span class="user-status is-online"></span> <em>Catherine J. Watkins</em></a>
                <a href="#"><span class="user-status is-online"></span> <em>Nicholas R. Walker</em></a>
                <a href="#"><span class="user-status is-busy"></span> <em>Susan J. Best</em></a>
                <a href="#"><span class="user-status is-offline"></span> <em>Brandon S. Young</em></a>
                <a href="#"><span class="user-status is-idle"></span> <em>Fernando G. Olson</em></a>
            </div>


            <div class="chat-group" id="group-2">
                <strong>Work</strong>

                <a href="#"><span class="user-status is-offline"></span> <em>Robert J. Garcia</em></a>
                <a href="#" data-conversation-history="#sample_history_2"><span class="user-status is-offline"></span> <em>Daniel A. Pena</em></a>
                <a href="#"><span class="user-status is-busy"></span> <em>Rodrigo E. Lozano</em></a>
            </div>


            <div class="chat-group" id="group-3">
                <strong>Social</strong>

                <a href="#"><span class="user-status is-busy"></span> <em>Velma G. Pearson</em></a>
                <a href="#"><span class="user-status is-offline"></span> <em>Margaret R. Dedmon</em></a>
                <a href="#"><span class="user-status is-online"></span> <em>Kathleen M. Canales</em></a>
                <a href="#"><span class="user-status is-offline"></span> <em>Tracy J. Rodriguez</em></a>
            </div>

        </div>

        <!-- conversation template -->
        <div class="chat-conversation">

            <div class="conversation-header">
                <a href="#" class="conversation-close"><i class="entypo-cancel"></i></a>

                <span class="user-status"></span>
                <span class="display-name"></span>
                <small></small>
            </div>

            <ul class="conversation-body">
            </ul>

            <div class="chat-textarea">
                <textarea class="form-control autogrow" placeholder="Type your message"></textarea>
            </div>

        </div>

    </div>


    <!-- Chat Histories -->
    <ul class="chat-history" id="sample_history">
        <li>
            <span class="user">Art Ramadani</span>
            <p>Are you here?</p>
            <span class="time">09:00</span>
        </li>

        <li class="opponent">
            <span class="user">Catherine J. Watkins</span>
            <p>This message is pre-queued.</p>
            <span class="time">09:25</span>
        </li>

        <li class="opponent">
            <span class="user">Catherine J. Watkins</span>
            <p>Whohoo!</p>
            <span class="time">09:26</span>
        </li>

        <li class="opponent unread">
            <span class="user">Catherine J. Watkins</span>
            <p>Do you like it?</p>
            <span class="time">09:27</span>
        </li>
    </ul>




    <!-- Chat Histories -->
    <ul class="chat-history" id="sample_history_2">
        <li class="opponent unread">
            <span class="user">Daniel A. Pena</span>
            <p>I am going out.</p>
            <span class="time">08:21</span>
        </li>

        <li class="opponent unread">
            <span class="user">Daniel A. Pena</span>
            <p>Call me when you see this message.</p>
            <span class="time">08:27</span>
        </li>
    </ul>


</div>

<!-- Sample Modal (Default skin) -->
<div class="modal fade" id="sample-modal-dialog-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Widget Options - Default Modal</h4>
            </div>

            <div class="modal-body">
                <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Sample Modal (Skin inverted) -->
<div class="modal invert fade" id="sample-modal-dialog-2">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Widget Options - Inverted Skin Modal</h4>
            </div>

            <div class="modal-body">
                <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Sample Modal (Skin gray) -->
<div class="modal gray fade" id="sample-modal-dialog-3">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Widget Options - Gray Skin Modal</h4>
            </div>

            <div class="modal-body">
                <p>Now residence dashwoods she excellent you. Shade being under his bed her. Much read on as draw. Blessing for ignorant exercise any yourself unpacked. Pleasant horrible but confined day end marriage. Eagerness furniture set preserved far recommend. Did even but nor are most gave hope. Secure active living depend son repair day ladies now.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>




<!-- Imported styles on this page -->
<link rel="stylesheet" href="{{asset('assets/admin/')}}/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="{{asset('assets/admin/')}}/js/rickshaw/rickshaw.min.css">

{{--<link rel="stylesheet" href="{{asset('assets/admin/')}}/js/datatables/datatables.css">--}}
{{--<link rel="stylesheet" href="{{asset('assets/admin/')}}/js/select2/select2-bootstrap.css">--}}
{{--<link rel="stylesheet" href="{{asset('assets/admin/')}}/js/select2/select2.css">--}}


<!-- Bottom scripts (common) -->
<script src="{{asset('assets/admin/')}}/js/gsap/TweenMax.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/bootstrap.js"></script>
<script src="{{asset('assets/admin/')}}/js/joinable.js"></script>
<script src="{{asset('assets/admin/')}}/js/resizeable.js"></script>
<script src="{{asset('assets/admin/')}}/js/neon-api.js"></script>
<script src="{{asset('assets/admin/')}}/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


<!-- Imported scripts on this page -->
<script src="{{asset('assets/admin/')}}/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="{{asset('assets/admin/')}}/js/jquery.sparkline.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/rickshaw/vendor/d3.v3.js"></script>
<script src="{{asset('assets/admin/')}}/js/rickshaw/rickshaw.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/raphael-min.js"></script>
<script src="{{asset('assets/admin/')}}/js/morris.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/toastr.js"></script>
<script src="{{asset('assets/admin/')}}/js/neon-chat.js"></script>

{{--<script src="{{asset('assets/admin/')}}/js/datatables/datatables.js"></script>--}}
{{--<script src="{{asset('assets/admin/')}}/js/select2/select2.min.js"></script>--}}
{{--<script src="{{asset('assets/admin/')}}/js/neon-chat.js"></script>--}}



<!-- JavaScripts initializations and stuff -->
<script src="{{asset('assets/admin/')}}/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="{{asset('assets/admin/')}}/js/neon-demo.js"></script>
@yield('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('layouts.message')
</body>
</html>