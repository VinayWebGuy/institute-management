<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A IELTS PTE Portal by Vinay">
    <meta name="author" content="A Web Portal by Vinay">
    <meta name="keywords" content="ielts,pte,portal,study visa">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>Login – Key2Success</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dark-style') }}.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/skin-modes') }}.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/colors/color1.css') }}" />

</head>

<body class="app sidebar-mini ltr">

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img" alt="">
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                            <span class="login100-form-title pb-5">
                                Login
                            </span>
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class="mx-0"><a href="#tab5" class="@if(!Session::has('key_error')) {{'active'}} @endif"
                                                    data-bs-toggle="tab">Email</a></li>
                                            <li class="mx-0"><a href="#tab6" class="@if(Session::has('key_error')) {{'active'}} @endif" data-bs-toggle="tab">Key</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body p-0 pt-5">
                                    <div class="tab-content">
                                        <div class="tab-pane  @if(!Session::has('key_error')) {{'active'}} @endif" id="tab5">
                                            <form method="post" action="{{url('login')}}">
                                                @csrf
                                            <div class="wrap-input100 validate-input input-group">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input required class="input100 border-start-0 form-control ms-0" type="email" name="email"
                                                    placeholder="Email" autocomplete="off">
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input required class="input100 border-start-0 form-control ms-0" type="password" name="password"
                                                    placeholder="Password">
                                            </div>
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                            <div class="text-end pt-4">
                                                <p class="mb-0"><a href="{{url('forget-password')}}"
                                                        class="text-primary ms-1">Forgot Password?</a></p>
                                            </div>
                                            @if(Session::has('error'))
                                            <span class="text-danger text-center">{{Session::get('error')}}</span>
                                            @endif
                                            @if(Session::has('success'))
                                            <span class="text-success text-center">{{Session::get('success')}}</span>
                                            @endif
                                            <div class="container-login100-form-btn">
                                                <button type="submit" class="login100-form-btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                        </div>
                                        <div class="tab-pane @if(Session::has('key_error')) {{'active'}} @endif" id="tab6">
                                            <form method="post" action="{{url('login-with-key')}}">
                                                @csrf
                                            <div id="mobile-num"
                                                class="wrap-input100 validate-input input-group mb-4">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <span>Key</span>
                                                </a>
                                                <input type="password" required name="key" class="input100 border-start-0 form-control ms-0">
                                            </div>
                                            @error('key')
                                                <span class="text-danger">{{$message}}</span>
                                                <br>
                                            @enderror
                                            @if(Session::has('key_error'))
                                            <span class="text-danger">{{Session::get('key_error')}}</span>
                                            <br>
                                            @endif
                                            <span>Note : Login with given Key for instant login</span>
                                            <div class="container-login100-form-btn ">
                                                <button type="submit" class="login100-form-btn btn-primary">Proceed</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{ asset('assets/js/show-password.min.js') }}"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{ asset('assets/js/generate-otp.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('assets/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
