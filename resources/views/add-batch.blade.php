@extends('layouts.main')
@section('title', 'Add Batch')
@section('batch', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Batch</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Batch</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Batch</li>
                        </ol>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.add-batch') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Batch Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <input type="text" name="name" class="form-control" id="nameInput"
                                                placeholder="Name">
                                            @error('name')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control select2-show-search form-select"
                                                data-placeholder="Choose Staff" name="assigned_staff" id="staff-select">
                                                <option label="Choose Staff"></option>
                                                @foreach ($staff as $s)
                                                    <option value="{{ $s->id }}">{{ $s->username }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <select name="morning_evening" id="morning_evening" class="form-control">
                                                    <option value="" hidden>Select Time</option>
                                                    <option value="1">Morning</option>
                                                    <option value="2">Evening</option>
                                                </select>
                                            </div>
                                            @error('morning_evening')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <select name="status" name="status" id="status" class="form-control">
                                                    <option value="" hidden>Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            @error('status')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div><input class="form-control fc-datepicker" placeholder="Start Date"
                                                        type="text" id="start_date" name="start_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div><input class="form-control fc-datepicker" placeholder="End Date"
                                                        type="text" id="end_date" name="end_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="input-group wd-150">
                                                <div class="input-group-text">
                                                    <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                                </div>
                                                <!-- input-group-text -->
                                                <input class="form-control br-0 ui-timepicker-input timeInp"
                                                    placeholder="From" name="from_time" value="" type="text"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="input-group wd-150">
                                                <div class="input-group-text">
                                                    <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                                </div>
                                                <!-- input-group-text -->
                                                <input class="form-control br-0 ui-timepicker-input timeInp"
                                                    placeholder="To" value="" name="to_time" type="text"
                                                    autocomplete="off">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <button type="submit" class="btn btn-success btn-lg"><i
                                    class="fe fe-check me-2"></i>Save</button>
                        </div>
                    </div>
                </form>
                <!-- /Row -->
            </div>
            <!-- CONTAINER CLOSED -->

        </div>
    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Batch data added successfully', 'success');
        </script>
    @endif
@endsection
