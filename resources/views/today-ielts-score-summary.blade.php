@extends('layouts.main')
@section('title', 'Today IELTS score summary')
@section('ielts', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Today IELTS score summary</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">IELTS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Today IELTS score summary</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Today IELTS score summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-10 border-bottom-0">Name</th>
                                                <th class="wd-10 border-bottom-0">Date</th>
                                                <th class="wd-10 border-bottom-0">Kind</th>
                                                <th class="wd-10 border-bottom-0">Type</th>
                                                <th class="wd-10 border-bottom-0">Overall</th>
                                                <th class="wd-10 border-bottom-0">Reading</th>
                                                <th class="wd-10 border-bottom-0">Writing 1</th>
                                                <th class="wd-10 border-bottom-0">Writing 2</th>
                                                <th class="wd-10 border-bottom-0">Listening</th>
                                                <th class="wd-10 border-bottom-0">Speaking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$user->username}}</td>
                                                <td>
                                                    @if(isset($score)) {{$score->date}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->kind}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->type}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->overall}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->reading}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->writing1}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->writing2}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->listening}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
                                                <td>
                                                    @if(isset($score)) {{$score->speaking}} @else <span class="text-danger">Not marked yet </span> @endif
                                                </td>
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
