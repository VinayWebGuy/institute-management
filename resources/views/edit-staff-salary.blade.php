@extends('layouts.main')
@section('title', 'Edit Staff Salary')
@section('staff', 'active')
@section('content')
@php
$salaryDet = DB::table('salary_details')
    ->where('user_id', $user->id)
    ->first();
    $months = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
@endphp
<div class="main-content app-content mt-0">
<div class="side-app">
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Edit Staff Salary</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Salary</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Staff Salary</li>
                </ol>
            </div>
        </div>
        <form method="post" action="{{ route('admin.edit-staff-salary') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="hidden" name="salary_id" value="{{ $salaryDet->id }}">
            <input type="hidden" name="sid" value="{{ $salary->id }}">
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Salary of {{ $user->username }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="valueInput">Value</label>
                                    <input required type="number" name="value"
                                        class="form-control number-without-arrow" id="valueInput"
                                        placeholder="Value"
                                        value="@isset($salary->value){{ $salary->value }}@endif">
                                    @error('value')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="monthInput">Month</label>
                                        <select class="form-control select2-show-search form-select"
                                            data-placeholder="@if($salary->month!='') {{$months[$salary->month]}} @else {{'Choose Month'}} @endif" name="month" id="monthInput">
                                            <option label="Choose Month"></option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    @error('month')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dateInput">Date</label>
                                    <input type="date" value="@isset($salary->added_on){{$salary->added_on}}@endisset" name="added_on" id="dateInput" class="form-control">
                                    @error('added_on')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <button type="submit" class="btn btn-success btn-lg"><i
                            class="fe fe-check me-2"></i>Update</button>
                </div>
            </div>
        </form>

    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Salary updated successfully', 'success');
        </script>
    @endif
@endsection
