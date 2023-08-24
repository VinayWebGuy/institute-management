@extends('layouts.main')
@section('title', 'IELTS score report')
@section('ielts', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">IELTS score report</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">IELTS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">IELTS score report</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">IELTS score report</h3>
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
                                                <th class="wd-20p border-bottom-0">Name</th>
                                                <th class="wd-20p border-bottom-0">Email</th>
                                                <th class="wd-20p border-bottom-0">Today Overall Score</th>
                                                <th class="wd-40p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                @php
                                                    $student = DB::table('students')
                                                        ->where('user_id', $user->id)
                                                        ->first();
                                                        $today_score = DB::table('ielts_scores')->where('user_id',$user->id)->where('date',date('Y-m-d'))->first();
                                                @endphp
                                                @if ($student->course_type == 'ielts')
                                                    <tr>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @if($today_score)
                                                                {{$today_score->overall}}
                                                            @else
                                                                <span class="badge bg-red">Not Marked Yet</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(Session::get('role')==1)
                                                            <a href="{{url('admin/ielts/today-score-summary')}}/{{$user->unique_key}}" class="btn btn-green">View Today Score Summary</a>
                                                            <a href="{{url('admin/ielts/overall-score-summary')}}/{{$user->unique_key}}" class="btn btn-purple">View Overall Score Summary</a>
                                                            @else
                                                            <a href="{{url('staff/ielts/today-score-summary')}}/{{$user->unique_key}}" class="btn btn-green">View Today Score Summary</a>
                                                            <a href="{{url('staff/ielts/overall-score-summary')}}/{{$user->unique_key}}" class="btn btn-purple">View Overall Score Summary</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
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

    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Score updated successfully', 'success');
        </script>
    @endif
@endsection
