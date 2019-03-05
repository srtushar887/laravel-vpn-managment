<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="{{asset('assets/admin/')}}/images/favicon.ico">

    <title>Neon | Login</title>

    <link rel="stylesheet" href="{{asset('assets/admin/')}}/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/neon-core.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/neon-theme.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/neon-forms.css">
    <link rel="stylesheet" href="{{asset('assets/admin/')}}/css/custom.css">

    <script src="{{asset('assets/admin/')}}/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="{{asset('assets/admin/')}}/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
    var baseurl = '';
</script>

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">

            <a href="index.html" class="logo">
                <img src="{{asset('assets/admin/')}}/images/logo@2x.png" width="120" alt="" />
            </a>

            <p class="description">Dear user, log in to access the admin area!</p>

            <!-- progress bar indicator -->
            <div class="login-progressbar-indicator">
                <h3>43%</h3>
                <span>logging in...</span>
            </div>
        </div>

    </div>

    <div class="login-progressbar">

        <div></div>
    </div>

    <div class="login-form">

        <div class="login-content">

            <div class="form-login-error">
                {{--                @include('layouts.error')--}}

                <h3>Invalid login</h3>
                <p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
            </div>
            @if(Session::has('errorlogin'))
                <h5 style="color: red">{{Session::get('errorlogin')}}</h5>
            @endif
            <form method="post" action="{{route('subreseller.login.submit')}}" role="form" id="">
                @csrf
                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user"></i>
                        </div>

                        <input type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}"  id="username" placeholder="User Name" autocomplete="off" />

                    </div>
                    @if ($errors->has('user_name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>

                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password" autocomplete="off" />

                    </div>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-login"></i>
                        Login In
                    </button>
                </div>
                <div class="form-group">
                    <a href="{{url('/')}}">
                        <button type="button" class="btn btn-primary btn-block btn-login">
                            <i class="entypo-login"></i>
                            Return Back
                        </button>
                </div>
                </a>



            </form>


            <div class="login-bottom-links" style="margin-top: -30px">

                <a href="extra-forgot-password.html" class="link">Forgot your password?</a>

                <br />

                <a href="#">Developed By</a>  - <a href="#">SR Tusher</a>

            </div>

        </div>

    </div>

</div>


<!-- Bottom scripts (common) -->
<script src="{{asset('assets/admin/')}}/js/gsap/TweenMax.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/bootstrap.js"></script>
<script src="{{asset('assets/admin/')}}/js/joinable.js"></script>
<script src="{{asset('assets/admin/')}}/js/resizeable.js"></script>
<script src="{{asset('assets/admin/')}}/js/neon-api.js"></script>
<script src="{{asset('assets/admin/')}}/js/jquery.validate.min.js"></script>
<script src="{{asset('assets/admin/')}}/js/neon-login.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="{{asset('assets/admin/')}}/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="{{asset('assets/admin/')}}/js/neon-demo.js"></script>

</body>
</html>