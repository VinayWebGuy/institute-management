@extends('layouts.main')
@section('title', 'Disussion Hub')
@section('discussion', 'active')
@section('content')
<style>
    .chat-right{
        padding: 0 10px 0 25px !important;
    }
    .chat-left{
        padding: 0 25px 0 10px !important;
    }
    .nav-link{
        display: block !important;
    }
</style>
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Discussion Hub</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Discussion Hub</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            {{-- <div class="card-body">
                                    <div class="row">
                                        <div class="discussion-hub">
                                                <div class="msgs">

                                                </div>
                                                <div class="inputs">
                                                        <input type="text">
                                                        <input type="file" name="" id="">
                                                        <span class="text-primary"><i class="fe fe-link"></i></span>
                                                        <button class="btn btn-cyan"></button>
                                                </div>
                                        </div>
                                    </div>
                                </div> --}}
                            <div class="main-content-app pt-0">
                                <div class="main-content-body main-content-body-chat h-100">
                                    <div class="main-chat-header pt-3 d-block d-sm-flex">
                                        <div class="main-img-user chat-user">PC</div>
                                        <div class="main-chat-msg-name mt-2">
                                            <h6>Portal Community</h6>
                                            <small class="me-3">Ask anything related to the portal.</small>
                                        </div>
                                    </div>
                                    <!-- main-chat-header -->
                                    <div class="main-chat-body flex-2 ps ps--active-y" id="ChatBody"
                                        style="overflow-y: auto !important">
                                        <div class="content-inner chat-body">
                                            @foreach ($msgs as $msg)
                                            @if($msg->user_id==Session::get('id'))
                                             <div class="media flex-row-reverse chat-right">
                                                <div class="main-img-user chat-user">Me</div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper">
                                                        {{$msg->msg}}
                                                        @if($msg->file!=null)
                                                            <em class="ml-2"><a href="{{asset('assets/discussionHub')}}/{{$msg->file}}" target="_blank" class="text-primary">(File)</a></em>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <span>{{$msg->created_at->diffForHumans()}}</span> <a href=""><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            @php
                                                $usr = DB::table('users')->where('id',$msg->user_id)->first();
                                                $more  = DB::table('user_more')->where('user_id',$msg->user_id)->first();
                                            @endphp
                                            <div class="media chat-left">
                                                <div class="main-img-user chat-user">
                                                    @if(isset($more) && $more->profile_pic!='')
                                                   <a target="_blank" href="{{url('enter-club')}}/{{$usr->unique_key}}">
                                                    <img src="{{ asset('assets/images/staff-students/')}}/{{$more->profile_pic}}"
                                                    alt="profile-user">
                                                   </a>
                                                    @else
                                                    <a target="_blank" href="{{url('enter-club')}}/{{$usr->unique_key}}">{{strtoupper($usr->username[0])}}</a>
                                                    @endif
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper">
                                                        {{$msg->msg}}
                                                         @if($msg->file!=null)   
                                                            <em class="ml-2"><a href="{{asset('assets/discussionHub')}}/{{$msg->file}}" target="_blank" class="text-primary">(File)</a></em>
                                                         @endif
                                                    </div>
                                                    <div>
                                                        <span>{{$msg->created_at->diffForHumans()}}</span> <a href=""><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                           @endif
                                            @endforeach
                                            
                                        </div>
                                        <div class="ps__rail-x" style="left: 0px; bottom: -200px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 200px; height: 37px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 5px; height: 1px;"></div>
                                        </div>
                                    </div>
                                    <form class="main-chat-footer" id="discussion-form" enctype="multipart/form-data">
                                        @csrf
                                        <input class="form-control" placeholder="Type your message here..."
                                            type="text" id="chat-msg" name="msg">
                                        <a class="nav-link" id="file-attach" data-bs-toggle="tooltip"
                                            href="javascript:void(0)" title=""
                                            data-bs-original-title="Attach a File" aria-label="Attach a File"><span class="files-count"></span><i
                                                class="fe fe-paperclip"></i></a>
                                            
                                        <input type="file" name="file" id="files-chat">
                                        <button type="submit"  id="send-chat-btn" disabled class="btn btn-icon  btn-primary brround"><i
                                                class="fa fa-paper-plane-o"></i></button>
                                        <nav class="nav">
                                        </nav>
                                    </form>
                                    <strong class="text-danger py-3 px-4" id="discussion-error"></strong>
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
            swal('Congratulations!', 'Expense data added successfully', 'success');
        </script>
    @endif
@endsection
