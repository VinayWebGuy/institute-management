@extends('layouts.main')
@section('title', 'Manage Staff Salary')
@section('staff', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Manage Staff Salary</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Staff Salary</li>
                    </ol>
                </div>
            </div>
            <form method="post" action="{{route('admin.manage-staff-salary')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enter Details Carefully</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="form-label"> Select Staff</label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="Choose one" name="user" id="staff-for-salary">
                                            <option label="Choose one"></option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->username}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Salary <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Enter the staff salary here so that you can manage this in your accounts report." aria-label="Enter the staff salary here so that you can manage this in your accounts report."></i></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="number" class="form-control number-without-arrow" aria-label="Amount" name="salary_amount" id="salary-amount">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">Salary Date <span class="text-cyan" id="salary-date"></span></label>
                                    <select class="form-control select2 form-select select2-hidden-accessible" data-placeholder="Choose one" name="salary_date" tabindex="-1" aria-hidden="true">
                                        <option label="Choose one">
                                        </option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                        <option value="5">5th</option>
                                        <option value="6">6th</option>
                                        <option value="7">7th</option>
                                        <option value="8">8th</option>
                                        <option value="9">9th</option>
                                        <option value="10">10th</option>
                                        <option value="11">11th</option>
                                        <option value="12">12th</option>
                                        <option value="13">13th</option>
                                        <option value="14">14th</option>
                                        <option value="15">15th</option>
                                        <option value="16">16th</option>
                                        <option value="17">17th</option>
                                        <option value="18">18th</option>
                                        <option value="19">19th</option>
                                        <option value="20">20th</option>
                                        <option value="21">21th</option>
                                        <option value="22">22th</option>
                                        <option value="23">23th</option>
                                        <option value="24">24th</option>
                                        <option value="25">25th</option>
                                        <option value="26">26th</option>
                                        <option value="27">27th</option>
                                        <option value="28">28th</option>
                                    </select>
                                </div>
                                <input hidden type="text" name="user_id" id="user-id-value">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <button type="submit" class="btn btn-success btn-lg" disabled id="salary-update-btn"><i class="fe fe-check me-2"></i>Update</button>
            </div>
        </div>
        </form>
            <!-- /Row -->
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script  src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script  src="{{asset('assets/js/sweet-alert.js')}}"></script>
@if(Session::has('success'))
<script>
swal('Congratulations!', 'Staff salary updated successfully', 'success');
</script>
@endif
@endsection