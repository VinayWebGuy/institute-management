@extends('layouts.main')
@section('title', 'Overall score')
@section('score', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Overall score</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Score</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Overall score</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Overall score</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if($student->course_type=='ielts')
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
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
                                            @foreach($scores as $score)
                                            <tr>
                                                <td>{{$score->date}}</td>
                                                <td>{{$score->kind}}</td>
                                                <td>{{$score->type}}</td>
                                                <td>{{$score->overall}}</td>
                                                <td>{{$score->reading}}</td>
                                                <td>{{$score->writing1}}</td>
                                                <td>{{$score->writing2}}</td>
                                                <td>{{$score->listening}}</td>
                                                <td>{{$score->speaking}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @elseif($student->course_type=='pte')
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
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
                                    @endif
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
