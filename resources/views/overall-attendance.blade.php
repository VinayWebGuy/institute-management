@extends('layouts.main')
@section('title', 'Overall Attendance')
@section('attendance', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Overall Attendance</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Attendance</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Overall Attendance</li>
                        </ol>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Overall Attendance</h3>
                                <form action="" method="get" class="col-md-4 d-flex">
                                    <input type="date" class="form-control" name="date" placeholder="Search by date"
                                        value="{{ $key }}">
                                        <button class="btn btn-purple ml-2"><i class="fe fe-search"></i></button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-50 border-bottom-0">Date</th>
                                                <th class="wd-50 border-bottom-0">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($attendance as $att)
                                            <tr>
                                                <td>{{$att->date}}</td>
                                                <td>{{$att->time}}</td>
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
    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('deleted'))
        <script>
            swal('Congratulations!', 'Batch data deleted successfully', 'success');
        </script>
    @endif
@endsection
