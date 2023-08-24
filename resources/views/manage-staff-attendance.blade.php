@extends('layouts.main')
@section('title', 'Manage Staff Attendance')
@section('staff', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Manage Staff Attendance</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Staff Attendance</li>
                    </ol>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h3 class="card-title col-md-8">Manage Staff Attendance</h3>
                            <form action="" method="get" class="col-md-4">
                                <input type="text" class="form-control" name="staff" placeholder="Search Staff"
                                    value="{{ $key }}">
                            </form>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-25p border-bottom-0">Username</th>
                                            <th class="wd-25p border-bottom-0">Profile Pic</th>
                                            <th class="wd-25p border-bottom-0">Time <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Press Enter after adding time" aria-label="Press Enter after adding time"></i></th>
                                            <th class="wd-25p border-bottom-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            {{-- Another Table --}}
                                            @php
                                                $more = DB::table('user_more')
                                                    ->where('user_id', $user->id)
                                                    ->first();
                                                    $att = DB::table('attendance')->where('user_id',$user->id)->where('date',date("Y-m-d"))->first();
                                            @endphp
                                            <tr>
                                                <td><a target="_blank" href="{{url('admin/staff-attendance')}}/{{$user->id}}">{{ $user->username }}</a></td>
                                                <td>
                                                    @if ($more->profile_pic != '')
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

                                              <td><div class="input-group wd-150">
                                                <div class="input-group-text">
                                                    <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                                </div>
                                                <!-- input-group-text -->
                                                <input @if($att)  {{'disabled'}} @endif class="form-control br-0 ui-timepicker-input timeInp" data-id="{{$user->id}}" id="tp{{$user->id}}" placeholder="Set time" value="@isset($att) {{$att->time}} @endisset" type="text" autocomplete="off">
                                                <button @if($att)  {{'disabled'}} @endif class="btn btn btn-primary br-ts-0 br-bs-0 setTimeButton timeBtn-{{$user->id}}" id="{{$user->id}}">Set Current Time</button>
                                            </div></td>
                                                <td id="save-td-{{$user->id}}">
                                                    @if($att)
                                                    <button class="btn btn-icon btn-green"
                                                    >Saved</button>
                                                    @else
                                                    <button disabled
                                                        class="btn btn-icon btn-cyan save-attendance" data-id="{{$user->id}}" id="btn-{{$user->id}}"><i class="fe fe-check"></i></button>
                                                        @endif
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
