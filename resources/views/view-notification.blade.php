@extends('layouts.main')
@section('title', 'View Notification')
@section('home', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">View Notification</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Notifications</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Notification</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{$notification->title}}</h4>
                            </div>
                            <div class="card-body notification-body">
                           
                                <p>{{$notification->description}}</p>
                                @if($notification->status==1)
                                    <a href="{{url('change-notification-status')}}/{{$notification->id}}" class="btn btn-danger btn-sm">Mark as Read</a>
                                @else
                                    <a href="{{url('change-notification-status')}}/{{$notification->id}}" class="btn btn-primary btn-sm">Mark as Unread</a>
                                @endif
                                @if($notification->type=='Message')
                                    <a href="{{url('enter-club')}}/{{$notification->msg_id}}" class="btn-sm btn btn-info mx-1">Enter Club</a>
                                @endif
                                <a href="{{url('delete-notification')}}/{{$notification->id}}" class="btn-sm btn btn-red mx-1">Delete Notification</a>
                                <div class="notification-time">
                                    {{\Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Notification updated successfully', 'success');
        </script>
    @endif
@endsection
