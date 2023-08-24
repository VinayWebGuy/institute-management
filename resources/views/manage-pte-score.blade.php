@extends('layouts.main')
@section('title', 'Manage PTE score')
@section('pte', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Manage PTE score</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">PTE</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage PTE score</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Manage PTE score</h3>
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
                                                <th class="wd-20p border-bottom-0">Date</th>
                                                <th class="wd-15p border-bottom-0">Type</th>
                                                <th class="wd-20p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                @php
                                                    $student = DB::table('students')
                                                        ->where('user_id', $user->id)
                                                        ->first();
                                                @endphp
                                                @if ($student->course_type == 'pte')
                                                    <tr>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        @if(Session::get('role')==1)
                                                        <form method="get"
                                                            action="{{ url('admin/pte/add-score') }}">
                                                            @else
                                                            <form method="get"
                                                                action="{{ url('staff/pte/add-score') }}">
                                                                @endif
                                                            <input type="hidden" name="user_key"
                                                                value="{{ $user->unique_key }}">
                                                            <td><input type="date" name="date" class="form-control"
                                                                    value="{{ date('Y-m-d') }}"></td>
                                                            <td>
                                                                <select name="type" id="type" class="form-control">
                                                                    <option value="Regular">Regular</option>
                                                                    <option value="Mock">Mock</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button type="submit" class="btn btn-purple">+</a>
                                                            </td>
                                                        </form>
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
