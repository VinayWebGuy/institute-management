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
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />
    <!-- TITLE -->
    <title>@yield('title') – Key2Success</title>
    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- STYLE CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/transparent-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />
    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/colors/color1.css') }}" />
    <link href="{{asset('assets/switcher/css/switcher.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/switcher/demo.css')}}" rel="stylesheet" />
</head>
@php
#Check Permission
$havePer = false;
$h_per = DB::table('permissions')->where('user_id',Session::get('id'))->first();
if($h_per){
    $havePer = true;
    $h_p = $h_per->permission;
    $h_br_p = explode(',',$h_p);
}
#Get Settings
$set = DB::table('settings')->where('user_id',Session::get('id'))->first();
#Get Notifications
$notifications = DB::table('notifications')->where('user_id',Session::get('id'))->where('status',1)->orderBy('id','desc')->limit(5)->get();
$notifications_count = DB::table('notifications')->where('user_id',Session::get('id'))->where('status',1)->orderBy('id','desc')->count();
@endphp
<body class="app sidebar-mini ltr light-mode">
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->
    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <!-- app-Header -->
            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0)"></a>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="{{ url('admin') }}">
                            <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo"
                                alt="logo">
                            <img src="{{ asset('assets/images/brand/logo-3.png') }}"
                                class="header-brand-img light-logo1" alt="logo">
                        </a>
                        <!-- LOGO -->
                        <div class="main-header-center ms-3 d-none d-lg-block">
                            <input disabled class="form-control" placeholder="Upgrade your account" type="search">
                            <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
                        </div>
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <div class="dropdown d-none">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fe fe-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- SEARCH -->
                            <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                            </button>
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex order-lg-2">
                                        <div class="dropdown d-lg-none d-flex">
                                            <a href="javascript:void(0)" class="nav-link icon"
                                                data-bs-toggle="dropdown">
                                                <i class="fe fe-search"></i>
                                            </a>
                                            <div class="dropdown-menu header-search dropdown-menu-start">
                                                <div class="input-group w-100 p-2">
                                                    <input type="text" class="form-control" placeholder="Search....">
                                                    <div class="input-group-text btn btn-primary">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- COUNTRY -->
                                        <!-- Country Modal  Starts-->
                                        {{-- <div class="d-flex country">
                                            <a class="nav-link icon text-center" data-bs-target="#country-selector"
                                                data-bs-toggle="modal">
                                                <i class="fe fe-globe"></i><span
                                                    class="fs-16 ms-2 d-none d-xl-block">English</span>
                                            </a>
                                        </div> --}}
                                         <!-- Country Modal  Ends-->
                                        <!-- SEARCH -->
                                        <div class="dropdown  d-flex">
                                            <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                            </a>
                                        </div>
                                        <!-- Theme-Layout -->
                                        <div class="dropdown d-flex">
                                            <a class="nav-link icon full-screen-link nav-link-bg">
                                                <i class="fe fe-minimize fullscreen-button"></i>
                                            </a>
                                        </div>
                                        <div class="dropdown d-flex">
                                            <a href="{{url('theme-customizer')}}" class="nav-link icon  nav-link-bg">
                                                <i class="fe fe-cpu"></i>
                                            </a>
                                        </div>
                                        <div class="dropdown d-flex">
                                            <a href="{{url('calendar')}}" class="nav-link icon  nav-link-bg">
                                                <i class="fe fe-calendar" ></i>
                                            </a>
                                        </div>
                                        <!-- FULL-SCREEN -->
                                        @if($set && $set->show_notifications==1)
                                        <div class="dropdown  d-flex notifications">
                                            <a class="nav-link icon noti-bell" data-bs-toggle="dropdown"><i
                                                    class="fe fe-bell"></i>
                                                    @if($notifications_count>0)
                                                    <span class=" pulse"></span>
                                                    @endif
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading border-bottom">
                                                    <div class="d-flex">
                                                        <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Recent Notifications
                                                        </h6>
                                                        @if($notifications_count>0)
                                                        <div class="ms-auto">
                                                            <a href="{{('mark-all-notifications-as-read')}}"
                                                                class="text-muted p-0 fs-12">Mark all as read</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="notifications-menu">
                                                    @if($notifications_count>0)
                                                    @foreach ($notifications as $notification)
                                                    <a class="dropdown-item d-flex" href="{{url('view-notification')}}/{{$notification->id}}">
                                                        <div
                                                            class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                            <i class="fa fa-bell"></i>
                                                        </div>
                                                        <div class="mt-1">
                                                            <h5 class="notification-label mb-1">{{$notification->title}}
                                                            </h5>
                                                            <span class="notification-subtext">{{\Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                        </div>
                                                    </a>
                                                    @endforeach
                                                    @else
                                                        <strong class="text-middle text-danger">No new notification</strong>
                                                    @endif
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                <a href="{{url('all-notifications')}}"
                                                    class="dropdown-item text-center p-3 text-muted">View all
                                                    Notifications</a>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- NOTIFICATIONS -->
                                        {{-- <div class="dropdown  d-flex message">
                                            <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                                                <i class="fe fe-message-square"></i><span class="pulse-danger"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading border-bottom">
                                                    <div class="d-flex">
                                                        <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">You have 5
                                                            Messages</h6>
                                                        <div class="ms-auto">
                                                            <a href="javascript:void(0)"
                                                                class="text-muted p-0 fs-12">make all unread</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message-menu">
                                                    <a class="dropdown-item d-flex" href="chat.html">
                                                        <span
                                                            class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                            data-bs-image-src="{{ asset('assets/images/users/1.jpg') }}"></span>
                                                        <div class="wd-90p">
                                                            <div class="d-flex">
                                                                <h5 class="mb-1">Peter Theil</h5>
                                                                <small class="text-muted ms-auto text-end">
                                                                    6:45 am
                                                                </small>
                                                            </div>
                                                            <span>Commented on file Guest list....</span>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item d-flex" href="chat.html">
                                                        <span
                                                            class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                            data-bs-image-src="{{ asset('assets/images/users/15.jpg') }}"></span>
                                                        <div class="wd-90p">
                                                            <div class="d-flex">
                                                                <h5 class="mb-1">Abagael Luth</h5>
                                                                <small class="text-muted ms-auto text-end">
                                                                    10:35 am
                                                                </small>
                                                            </div>
                                                            <span>New Meetup Started......</span>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item d-flex" href="chat.html">
                                                        <span
                                                            class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                            data-bs-image-src="{{ asset('assets/images/users/12.jpg') }}"></span>
                                                        <div class="wd-90p">
                                                            <div class="d-flex">
                                                                <h5 class="mb-1">Brizid Dawson</h5>
                                                                <small class="text-muted ms-auto text-end">
                                                                    2:17 pm
                                                                </small>
                                                            </div>
                                                            <span>Brizid is in the Warehouse...</span>
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item d-flex" href="chat.html">
                                                        <span
                                                            class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                            data-bs-image-src="{{ asset('assets/images/users/4.jpg') }}"></span>
                                                        <div class="wd-90p">
                                                            <div class="d-flex">
                                                                <h5 class="mb-1">Shannon Shaw</h5>
                                                                <small class="text-muted ms-auto text-end">
                                                                    7:55 pm
                                                                </small>
                                                            </div>
                                                            <span>New Product Realease......</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                <a href="javascript:void(0)"
                                                    class="dropdown-item text-center p-3 text-muted">See all
                                                    Messages</a>
                                            </div>
                                        </div> --}}
                                        <!-- MESSAGE-BOX -->
                                        {{-- <div class="dropdown d-flex header-settings">
                                            <a href="javascript:void(0);" class="nav-link icon"
                                                data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                                <i class="fe fe-align-right"></i>
                                            </a>
                                        </div> --}}
                                        <!-- SIDE-MENU -->
                                        <div class="dropdown d-flex profile-1">
                                            <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                                class="nav-link leading-none d-flex">
                                                @if(Session::get('role')!=1)
                                                @php
                                                 $moreData = DB::table('user_more')->where('user_id',Session::get('id'))->first();
                                                 @endphp
                                                 @if($moreData->profile_pic!='')
                                                 <img src="{{ asset('assets/images/staff-students/')}}/{{$moreData->profile_pic}}"
                                                 alt="profile-user"
                                                 class="avatar  profile-user brround cover-image">
                                                 @else
                                                    <span class="avatar  profile-user brround cover-image text-black">{{Session::get('username')[0]}}</span>
                                                 @endif
                                                {{-- <img src="{{ asset('assets/images/users/21.jpg') }}"
                                                    alt="profile-user"
                                                    class="avatar  profile-user brround cover-image"> --}}
                                                    @else
                                                    <span class="avatar  profile-user brround cover-image text-black">{{Session::get('username')[0]}}+</span>
                                                    @endif
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                <div class="drop-heading">
                                                    <div class="text-center">
                                                        <h5 class="text-dark mb-0 fs-14 fw-semibold">{{Session::get('username')}}</h5>
                                                        <small class="text-muted">
                                                            @if(Session::get('role')==1)
                                                            {{'Admin'}}
                                                            @elseif(Session::get('role')==2)
                                                            {{'Staff'}}
                                                            @elseif(Session::get('role')==2)
                                                            {{'Student'}}
                                                            @else
                                                            {{'Unknown'}}
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider m-0"></div>
                                                @if(Session::has('login_with_key') && Session::get('login_with_key')=="no")
                                                @if(Session::get('role')==2)
                                                <a class="dropdown-item" href="{{url('staff/profile')}}">
                                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                                </a>
                                                @elseif(Session::get('role')==3)
                                                <a class="dropdown-item" href="{{url('student/profile')}}">
                                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                                </a>
                                                @endif
                                                @endif
                                                @if (Session::get('role')!=2 || ($havePer && in_array('Change Password', $h_br_p)))
                                                <a class="dropdown-item" href="{{url('change-password')}}">
                                                    <i class="dropdown-icon fe fe-slack"></i> Change Password
                                                </a>
                                                @endif
                                                @php
                                                $m = DB::table('users')->where('id',Session::get('id'))->first();
                                                    $un_msgs = DB::table('club')->where('to_id',$m->unique_key)->where('read',0)->count();
                                                @endphp
                                                <!--<a class="dropdown-item" href="{{url('club')}}">-->
                                                <!--    <i class="dropdown-icon fe fe-mail"></i> Club-->
                                                <!--    @if($un_msgs>0)-->
                                                <!--    <span class="badge bg-primary rounded-pill float-end">{{$un_msgs}}</span>-->
                                                <!--    @endif-->
                                                <!--</a>-->
                                                @if($set && $set->enable_lockscreen==1)
                                                <a class="dropdown-item" href="{{url('lockscreen')}}">
                                                    <i class="dropdown-icon fe fe-lock"></i> Lockscreen
                                                </a>
                                                @endif
                                                <a class="dropdown-item" href="{{url('logout')}}">
                                                    <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->
            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="{{url('admin')}}">
                            <img src="{{ asset('assets/images/brand/logo.png') }}"
                                class="header-brand-img desktop-logo" alt="logo">
                            <img src="{{ asset('assets/images/brand/logo-1.png') }}"
                                class="header-brand-img toggle-logo" alt="logo">
                            <img src="{{ asset('assets/images/brand/logo-2.png') }}"
                                class="header-brand-img light-logo" alt="logo">
                            <img src="{{ asset('assets/images/brand/logo-3.png') }}"
                                class="header-brand-img light-logo1" alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    @if(Session::get('role')==1)
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Menu</h3>
                            </li>
                            <li class="slide @yield('home')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('admin')}}"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>
                            <li class="slide @yield('staff')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Staff</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Staff</a></li>
                                    <li><a href="{{url('admin/add-staff')}}" class="slide-item"> Add Staff</a></li>
                                    <li><a href="{{url('admin/all-staff')}}" class="slide-item"> All Staff</a></li>
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                            href="javascript:void(0)"><span
                                                class="sub-side-menu__label">Staff More</span><i
                                                class="sub-angle fe fe-chevron-right"></i></a>
                                        <ul class="sub-slide-menu">
                                            <li><a href="{{url('admin/manage-staff-salary')}}" class="sub-slide-item">Manage Staff Salary</a></li>
                                            <li><a href="{{url('admin/provide-staff-salary')}}" class="sub-slide-item">Provide Staff Salary</a></li>
                                            <li><a href="{{url('admin/manage-staff-attendance')}}" class="sub-slide-item"> Staff Attendance</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide @yield('batch')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-clock"></i><span
                                        class="side-menu__label">Batch</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Batch</a></li>
                                    <li><a href="{{url('admin/add-batch')}}" class="slide-item"> Add Batch</a></li>
                                    <li><a href="{{url('admin/all-batch')}}" class="slide-item"> All Batches</a></li>
                                </ul>
                            </li>
                            <li class="slide @yield('student')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Student</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Student</a></li>
                                    <li><a href="{{url('admin/add-student')}}" class="slide-item"> Add Student</a></li>
                                    <li><a href="{{url('admin/all-students')}}" class="slide-item"> All Students</a></li>
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                            href="javascript:void(0)"><span
                                                class="sub-side-menu__label">Student More</span><i
                                                class="sub-angle fe fe-chevron-right"></i></a>
                                        <ul class="sub-slide-menu">
                                            <li><a href="{{url('admin/manage-student-fees')}}" class="sub-slide-item"> Student Fees</a></li>
                                            <li><a href="{{url('admin/manage-student-attendance')}}" class="sub-slide-item"> Student Attendance</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide @yield('study_material')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-book"></i><span
                                        class="side-menu__label">Study Material</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Study Material</a></li>
                                    <li><a href="{{url('admin/add-study-material')}}" class="slide-item"> Add Study Material</a></li>
                                    <li><a href="{{url('admin/all-study-materials')}}" class="slide-item"> All Study Materials</a></li>
                                </ul>
                            </li>
                            <li class="slide @yield('ielts')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-italic"></i><span
                                        class="side-menu__label">IELTS</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">IELTS</a></li>
                                    <li><a href="{{url('admin/ielts/manage-score')}}" class="slide-item"> Manage Score</a></li>
                                    <li><a href="{{url('admin/ielts/score-report')}}" class="slide-item">Score Report</a></li>
                                </ul>
                            </li>
                            <li class="slide @yield('pte')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-headphones"></i><span
                                        class="side-menu__label">PTE</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">PTE</a></li>
                                    <li><a href="{{url('admin/pte/manage-score')}}" class="slide-item"> Manage Score</a></li>
                                    <li><a href="{{url('admin/pte/score-report')}}" class="slide-item">Score Report</a></li>
                                </ul>
                            </li>
                            <li class="slide @yield('enquiry')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon icon icon-bubbles"></i><span
                                        class="side-menu__label">Enquiry</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Enquiry</a></li>
                                    <li><a href="{{url('admin/add-enquiry')}}" class="slide-item"> Add Enquiry</a></li>
                                    <li><a href="{{url('admin/all-enquiries')}}" class="slide-item">All Enquiries</a></li>
                                </ul>
                            </li>
                            <!--<li class="slide @yield('custom-notification')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i-->
                            <!--            class="side-menu__icon fe fe-bell"></i><span-->
                            <!--            class="side-menu__label">Custom Notification</span><i-->
                            <!--            class="angle fe fe-chevron-right"></i></a>-->
                            <!--    <ul class="slide-menu">-->
                            <!--        <li class="side-menu-label1"><a href="javascript:void(0)">Custom Notification</a></li>-->
                            <!--        <li><a href="{{url('admin/add-custom-notification')}}" class="slide-item"> Add Custom Notification</a></li>-->
                            <!--        <li><a href="{{url('admin/all-custom-notifications')}}" class="slide-item">All Custom Notification</a></li>-->
                            <!--    </ul>-->
                            <!--</li>-->
                            <li class="slide @yield('expense')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('admin/expense-manager')}}"><i
                                        class="side-menu__icon fe fe-dollar-sign"></i><span
                                        class="side-menu__label">Expense Mananger</span></a>
                            </li>
                            <li class="slide @yield('report')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('admin/reports')}}"><i
                                        class="side-menu__icon fe fe-file-text"></i><span
                                        class="side-menu__label">Reports</span></a>
                            </li>
                            <!--<li class="slide @yield('club')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('club')}}"><i-->
                            <!--            class="side-menu__icon fe fe-at-sign"></i><span-->
                            <!--            class="side-menu__label">Club</span></a>-->
                            <!--</li>-->
                            <!--<li class="slide @yield('discussion')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('discussion-hub')}}"><i-->
                            <!--            class="side-menu__icon fe fe-box"></i><span-->
                            <!--            class="side-menu__label">Discussion Hub</span></a>-->
                            <!--</li>-->
                            <!--<li class="slide @yield('2fa')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('two-factor-authentication')}}"><i-->
                            <!--            class="side-menu__icon fe fe-lock"></i><span-->
                            <!--            class="side-menu__label">2FA</span></a>-->
                            <!--</li>-->
                            <li class="slide @yield('settings')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('settings')}}"><i
                                        class="side-menu__icon fe fe-settings"></i><span
                                        class="side-menu__label">Settings</span></a>
                            </li>
                            <li class="slide @yield('help')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-help-circle"></i><span
                                        class="side-menu__label">Help</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Help</a></li>
                                    <li><a href="{{url('admin/add-help-block')}}" class="slide-item"> Add Help Block</a></li>
                                    <li><a href="{{url('admin/all-help-block')}}" class="slide-item"> All Help Block</a></li>
                                    <li><a href="{{url('help')}}" class="slide-item">Help</a></li>
                                </ul>
                            </li>
                            <li class="slide @yield('ticket')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('admin/tickets')}}"><i
                                        class="side-menu__icon fe fe-flag"></i><span
                                        class="side-menu__label">Tickets</span></a>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                    @elseif(Session::get('role')==2)
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Menu</h3>
                            </li>
                            <li class="slide @yield('home')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('staff')}}"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>
                            @if ($havePer && (in_array('Add Student', $h_br_p) || in_array('All Students', $h_br_p) || in_array('Student Fees', $h_br_p) || in_array('Student Attendance', $h_br_p)))
                            <li class="slide @yield('student')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Student</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Student</a></li>
                                    @if ($havePer && in_array('Add Student', $h_br_p))
                                    <li><a href="{{url('staff/add-student')}}" class="slide-item"> Add Student</a></li>
                                    @endif
                                    @if ($havePer && in_array('All Students', $h_br_p))
                                    <li><a href="{{url('staff/all-students')}}" class="slide-item"> All Students</a></li>
                                    @endif
                                    @if ($havePer && (in_array('Student Fees', $h_br_p) || in_array('Student Attendance', $h_br_p)))
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                            href="javascript:void(0)"><span
                                                class="sub-side-menu__label">Student More</span><i
                                                class="sub-angle fe fe-chevron-right"></i></a>
                                        <ul class="sub-slide-menu">
                                            @if ($havePer && in_array('Student Fees', $h_br_p))
                                            <li><a href="{{url('staff/manage-student-fees')}}" class="sub-slide-item"> Student Fees</a></li>
                                            @endif
                                            @if ($havePer && in_array('Student Attendance', $h_br_p))
                                            <li><a href="{{url('staff/manage-student-attendance')}}" class="sub-slide-item"> Student Attendance</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if ($havePer && (in_array('Add Study Material', $h_br_p) || in_array('View Study Material', $h_br_p)))
                            <li class="slide @yield('study_material')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-book"></i><span
                                        class="side-menu__label">Study Material</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Study Material</a></li>
                                    @if ($havePer && in_array('Add Study Material', $h_br_p))
                                    <li><a href="{{url('staff/add-study-material')}}" class="slide-item"> Add Study Material</a></li>
                                    @endif
                                    @if ($havePer && in_array('View Study Material', $h_br_p))
                                    <li><a href="{{url('staff/all-study-materials')}}" class="slide-item"> All Study Materials</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if ($havePer && (in_array('Add Score', $h_br_p) || in_array('View Score Report', $h_br_p)))
                            <li class="slide @yield('ielts')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-italic"></i><span
                                        class="side-menu__label">IELTS</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">IELTS</a></li>
                                    @if ($havePer && in_array('Add Score', $h_br_p))
                                    <li><a href="{{url('staff/ielts/manage-score')}}" class="slide-item"> Manage Score</a></li>
                                    @endif
                                    @if ($havePer &&  in_array('View Score Report', $h_br_p))
                                    <li><a href="{{url('staff/ielts/score-report')}}" class="slide-item">Score Report</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if ($havePer && (in_array('Add Score', $h_br_p) || in_array('View Score Report', $h_br_p)))
                            <li class="slide @yield('pte')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-headphones"></i><span
                                        class="side-menu__label">PTE</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">PTE</a></li>
                                    @if ($havePer && in_array('Add Score', $h_br_p))
                                    <li><a href="{{url('staff/pte/manage-score')}}" class="slide-item"> Manage Score</a></li>
                                    @endif
                                    @if ($havePer &&  in_array('View Score Report', $h_br_p))
                                    <li><a href="{{url('staff/pte/score-report')}}" class="slide-item">Score Report</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if ($havePer && (in_array('Add Enquiry', $h_br_p) || in_array('View Enquiries', $h_br_p)))
                            <li class="slide @yield('enquiry')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon icon icon-bubbles"></i><span
                                        class="side-menu__label">Enquiry</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Enquiry</a></li>
                                    @if ($havePer && in_array('Add Enquiry', $h_br_p))
                                    <li><a href="{{url('staff/add-enquiry')}}" class="slide-item"> Add Enquiry</a></li>
                                    @endif
                                    @if ($havePer &&  in_array('View Enquiries', $h_br_p))
                                    <li><a href="{{url('staff/all-enquiries')}}" class="slide-item">All Enquiries</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            <li class="slide @yield('attendance')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-check"></i><span
                                        class="side-menu__label">Attendance</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Attendance</a></li>
                                    <li><a href="{{url('staff/today-attendance')}}" class="slide-item"> Today Attendance</a></li>
                                    <li><a href="{{url('staff/overall-attendance')}}" class="slide-item">Overall Attendance</a></li>
                                </ul>
                            </li>
                          
                            @if ($havePer &&  in_array('Reports', $h_br_p))
                            <li class="slide @yield('report')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('staff/reports')}}"><i
                                        class="side-menu__icon fe fe-file-text"></i><span
                                        class="side-menu__label">Reports</span></a>
                                    </li>
                            @endif
                            <!--<li class="slide @yield('club')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('club')}}"><i-->
                            <!--            class="side-menu__icon fe fe-at-sign"></i><span-->
                            <!--            class="side-menu__label">Club</span></a>-->
                            <!--</li>-->
                            <!--<li class="slide @yield('discussion')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('discussion-hub')}}"><i-->
                            <!--            class="side-menu__icon fe fe-box"></i><span-->
                            <!--            class="side-menu__label">Discussion Hub</span></a>-->
                            <!--</li>-->
                            <!--<li class="slide @yield('2fa')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('two-factor-authentication')}}"><i-->
                            <!--            class="side-menu__icon fe fe-lock"></i><span-->
                            <!--            class="side-menu__label">2FA</span></a>-->
                            <!--</li>-->
                            <li class="slide @yield('settings')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('settings')}}"><i
                                        class="side-menu__icon fe fe-settings"></i><span
                                        class="side-menu__label">Settings</span></a>
                            </li>
                            <li class="slide @yield('help')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('help')}}"><i
                                        class="side-menu__icon fe fe-help-circle"></i><span
                                        class="side-menu__label">Help</span></a>
                            </li>
                            <li class="slide @yield('ticket')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-flag"></i><span
                                        class="side-menu__label">Ticket</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Ticket</a></li>
                                    <li><a href="{{url('staff/raise-ticket')}}" class="slide-item"> Raise a Ticket</a></li>
                                    <li><a href="{{url('staff/my-tickets')}}" class="slide-item">My Tickets</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                    @elseif(Session::get('role')==3)
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Menu</h3>
                            </li>
                            <li class="slide @yield('home')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('admin')}}"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Dashboard</span></a>
                            </li>
                            <!--<li class="slide @yield('club')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('club')}}"><i class="side-menu__icon fe fe-at-sign"></i><span class="side-menu__label">Club</span></a>-->
                            <!--</li>-->
                            @php
                                $hasCourse = DB::table('students')->where('user_id',Session::get('id'))->first();
                            @endphp
                            @if($hasCourse->course_type!='')
                            <li class="slide @yield('study_material')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('student/study-material')}}"><i class="side-menu__icon fe fe-book"></i><span class="side-menu__label">Study Material</span></a>
                            </li>
                            <li class="slide @yield('score')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-star"></i><span
                                        class="side-menu__label">Score</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Score</a></li>
                                    <li><a href="{{url('student/today-score')}}" class="slide-item"> Today Score</a></li>
                                    <li><a href="{{url('student/overall-score')}}" class="slide-item">Overall Score</a></li>
                                </ul>
                            </li>
                            @endif
                            <li class="slide @yield('attendance')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-check"></i><span
                                        class="side-menu__label">Attendance</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Attendance</a></li>
                                    <li><a href="{{url('student/today-attendance')}}" class="slide-item"> Today Attendance</a></li>
                                    <li><a href="{{url('student/overall-attendance')}}" class="slide-item">Overall Attendance</a></li>
                                </ul>
                            </li>
                            <!--<li class="slide @yield('discussion')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('discussion-hub')}}"><i-->
                            <!--            class="side-menu__icon fe fe-box"></i><span-->
                            <!--            class="side-menu__label">Discussion Hub</span></a>-->
                            <!--</li>-->
                            <!--<li class="slide @yield('2fa')">-->
                            <!--    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('two-factor-authentication')}}"><i-->
                            <!--            class="side-menu__icon fe fe-lock"></i><span-->
                            <!--            class="side-menu__label">2FA</span></a>-->
                            <!--</li>-->
                            <li class="slide @yield('settings')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('settings')}}"><i
                                        class="side-menu__icon fe fe-settings"></i><span
                                        class="side-menu__label">Settings</span></a>
                            </li>
                            <li class="slide @yield('help')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('help')}}"><i
                                        class="side-menu__icon fe fe-help-circle"></i><span
                                        class="side-menu__label">Help</span></a>
                            </li>
                            <li class="slide @yield('ticket')">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-flag"></i><span
                                        class="side-menu__label">Ticket</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Ticket</a></li>
                                    <li><a href="{{url('student/raise-ticket')}}" class="slide-item"> Raise a Ticket</a></li>
                                    <li><a href="{{url('student/my-tickets')}}" class="slide-item">My Tickets</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                    @endif
                </div>
                <!--/APP-SIDEBAR-->
            </div>
            <!--app-content open-->