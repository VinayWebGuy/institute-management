@extends('layouts.main')
@section('title', 'Manage Student Fees')
@section('student', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Manage Student Fees</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Student Fees</li>
                    </ol>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h3 class="card-title col-md-8">Manage Student Attendance</h3>
                            <form action="" method="get" class="col-md-4">
                                <input type="text" class="form-control" name="student" placeholder="Search Student"
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
                                                    $att = DB::table('student_attendance')->where('user_id',$user->id)->where('date',date("Y-m-d"))->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $user->username }}</td>
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

                                             
                                                <td>
                                                    <a href="{{url('admin/add-student-fees')}}/{{$user->unique_key}}" class="btn btn-purple">+</a>
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
