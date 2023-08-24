@extends('layouts.main')
@section('title', 'Reports')
@section('report', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Reports</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reports</li>
                        </ol>
                    </div>
                </div>
                @if(Session::get('role')==1)
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Expense Report</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0)" class="card-options-collapse"
                                        data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{url('admin/generate-report')}}">
                                    <input type="hidden" name="kind" value="expense">
                                <div class="row">
                                        <div class="form-group col-md-4">
                                                <label for="fromDate">From Date</label>
                                                <input required id="fromDate" type="date" class="form-control" name="fromDate" >
                                                <strong class="text-danger" id="fromDateError"></strong>
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label for="fromDate">To Date</label>
                                                <input disabled required id="toDate" type="date" class="form-control" name="toDate">
                                                <strong class="text-danger" id="toDateError"></strong>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="type">Type</label>
                                            <select required name="types" id="type" class="form-control">
                                                <option value="all">All</option>
                                                <option value="credit">Credit</option>
                                                <option value="debit">Debit</option>
                                            </select>
                                            <strong class="text-danger" id="typeError"></strong>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-green" id="generateExpenseReport!">Generate </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Staff Report</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0)" class="card-options-collapse"
                                        data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{url('admin/generate-report')}}">
                                    <input type="hidden" name="kind" value="staff">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Columns</label>
                                        <select required class="form-control select2" name="column[]" data-placeholder="Choose Column" multiple>
                                                <option selected value="Username">
                                                    Username
                                                </option>
                                                <option selected value="Email">
                                                    Email
                                                </option>
                                                <option  value="Mobile">
                                                    Mobile
                                                </option>
                                                <option value="Password">
                                                    Password
                                                </option>
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-green" id="generateExpenseReport!">Generate </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student report</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0)" class="card-options-collapse"
                                        data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::get('role')==1)
                                <form method="get" action="{{url('admin/generate-report')}}">
                                    @else
                                <form method="get" action="{{url('staff/generate-report')}}">
                                    @endif
                                    <input type="hidden" name="kind" value="student">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Columns</label>
                                        <select required class="form-control select2" name="column[]" data-placeholder="Choose Column" multiple>
                                                <option selected value="Username">
                                                    Username
                                                </option>
                                                <option selected value="Email">
                                                    Email
                                                </option>
                                                <option  value="Mobile">
                                                    Mobile
                                                </option>
                                                <option value="Password">
                                                    Password
                                                </option>
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-green" id="generateExpenseReport!">Generate </button>
                                    </div>
                                </div>
                            </form>
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
            swal('Congratulations!', 'Student data added successfully', 'success');
        </script>
    @endif
@endsection
