@extends('layouts.main')
@section('title', 'Today Attendance')
@section('attendance', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Today Attendance</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Attendance</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Today Attendance</li>
                        </ol>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Today Attendance</h3>
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
                                            <tr>
                                            @if($att!='')
                                                <td>{{$att->date}}</td>
                                                <td>{{$att->time}}</td>
                                                @else
                                                <td><span class="text-danger">Not marked yet </span></td>
                                                <td><span class="text-danger">Not marked yet </span></td>
                                                @endif
                                            </tr>
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
