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
    <title>Reset Password – Key2Success</title>

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
            <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{asset('assets/images/brand/logo.png')}}" alt="Logo">
                    </div>
                </div>
                <!-- CONTAINER OPEN -->
                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        
                            <div class="text-center mb-4">
                               <i class="fa fa-user fa-2x"></i>
                                <h4>{{$user->username}}</h4>
                            </div>
                            <form method="post" action="{{url('reset-password')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                          <div class="form-group col-md-12">
                            <input type="password" class="form-control" name="new_password" placeholder="Your New Password">
                              @error('new_password')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          <div class="form-group col-md-12">
                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Your Password">
                              @error('confirm_password')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                            @if(Session::has('error'))
                            <span class="text-danger mb-2">{{Session::get('error')}}</span>
                            @endif
                            @if(Session::has('success'))
                            <span class="text-success mb-2">{{Session::get('success')}}</span>
                            @endif
                            <div class="container-login100-form-btn pt-0">
                                <button type="submit" class="login100-form-btn btn-primary">
										Reset
									</button>
                            </div>
                        
                            <div class="text-center pt-2">
                                <span class="txt1">
										Want to login?
									</span>
                                <a class="" href="{{url('login')}}">
										Click Here.
									</a>
                            </div>
                           
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End GLOABAL LOADER -->

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