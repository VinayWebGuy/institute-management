@extends('layouts.main')
@section('title', 'Club')
@section('club', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Club</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Club</li>
                    </ol>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h3 class="card-title col-md-8">Choose a member to enter the club</h3>
                            <form action="" method="get" class="col-md-4">
                                <input type="text" class="form-control" name="member" placeholder="Search Member"
                                    value="{{ $key }}">
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-25p border-bottom-0">Username</th>
                                            <th class="wd-25p border-bottom-0">Role</th>
                                            <th class="wd-25p border-bottom-0">Profile Pic</th>
                                            <th class="wd-25p border-bottom-0">Action <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Click on '+' icon to update student fees of respective student" aria-label="Click on '+' icon to update student fees of respective student"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            {{-- Another Table --}}
                                            @php
                                                $more = DB::table('user_more')
                                                    ->where('user_id', $user->id)
                                                    ->first();
                                                $m = DB::table('users')->where('id',Session::get('id'))->first();
                                                $u_msgs = DB::table('club')->where('from_id',$user->unique_key)->where('to_id',$m->unique_key)->where('read',0)->count();
                                            @endphp
                                            <tr>
                                                <td>{{ $user->username }}</td>
                                                <td>
                                                    @if (isset($more) && $more->profile_pic != '')
                                                        <a target="_blank"
                                                            href="{{ asset('assets/images/staff-students') }}/{{ $more->profile_pic }}">
                                                            <img src="{{ asset('assets/images/staff-students') }}/{{ $more->profile_pic }}"
                                                                class="profile-thumbnail" alt="">
                                                        </a>
                                                    @else
                                                        <span
                                                            class="profile-thumbnail-text">{{ $user->username[0] }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->role==1)
                                                    Admin   
                                                @elseif($user->role==2)
                                                    Staff
                                                @elseif($user->role==3)
                                                    Student
                                                @else
                                                @endif
                                                </td>

                                             
                                                <td>
                                                    <a target="_blank" href="{{url('enter-club')}}/{{$user->unique_key}}" class="btn btn-purple">+</a>
                                                    <span class="btn btn-green">{{$u_msgs}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

@endsection
