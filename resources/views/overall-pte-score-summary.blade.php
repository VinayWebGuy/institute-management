@extends('layouts.main')
@section('title', 'Overall PTE score summary')
@section('pte', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Overall PTE score summary</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">PTE</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Overall PTE score summary</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Overall PTE score summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-14 border-bottom-0">Name</th>
                                                <th class="wd-14 border-bottom-0">Date</th>
                                                <th class="wd-12 border-bottom-0">Type</th>
                                                <th class="wd-12 border-bottom-0">Overall</th>
                                                <th class="wd-12 border-bottom-0">Reading</th>
                                                <th class="wd-12 border-bottom-0">Writing</th>
                                                <th class="wd-12 border-bottom-0">Listening</th>
                                                <th class="wd-12 border-bottom-0">Speaking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($scores as $score)
                                            <tr>
                                                <td>{{$user->username}}</td>
                                                <td>{{$score->date}}</td>
                                                <td>{{$score->type}}</td>
                                                <td>{{$score->overall}}</td>
                                                <td>{{$score->reading}}</td>
                                                <td>{{$score->writing}}</td>
                                                <td>{{$score->listening}}</td>
                                                <td>{{$score->speaking}}</td>
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
