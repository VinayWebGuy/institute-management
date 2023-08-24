@extends('layouts.main')
@section('title', 'Provide Staff Salary')
@section('staff', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Provide Staff Salary</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Provide Staff Salary</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Provide Staff Salary</h3>
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
                                                <th class="wd-20p border-bottom-0">Name</th>
                                                <th class="wd-20p border-bottom-0">Mobile</th>
                                                <th class="wd-20p border-bottom-0">Email</th>
                                                <th class="wd-15p border-bottom-0">Salary</th>
                                                <th class="wd-15p border-bottom-0">Salary Day</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                            @php
                                                $salary = DB::table('salary_details')->where('user_id',$user->id)->first();
                                            @endphp
                                                <tr>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{$user->mobile}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>
                                                        @isset($salary->salary_amount) {{$salary->salary_amount}} @endisset
                                                    </td>
                                                    <td>
                                                        @isset($salary->salary_date) {{$salary->salary_date}} @endisset
                                                    </td>
                                                    <td>
                                                        @if(isset($salary))
                                                        <a href="{{url('admin/add-staff-salary')}}/{{$user->unique_key}}" class="btn btn-purple">+</a>
                                                        @else
                                                        <a href="javascript:void(0)" class="btn btn-purple">+</a>
                                                        <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Please enter salary details" aria-label="Please enter salary details"></i>
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

    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('deleted'))
        <script>
            swal('Congratulations!', 'Batch data deleted successfully', 'success');
        </script>
    @endif
@endsection
