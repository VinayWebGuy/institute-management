@extends('layouts.main')
@section('title', 'Edit Student')
@section('student', 'active')
@section('content')
@php
    $more = DB::table('user_more')->where('user_id',$user->id)->first();
    $student = DB::table('students')->where('user_id',$user->id)->first();
    $result = DB::table('results')->where('user_id',$user->id)->first();

    #Check Course Detail Exist or not
    $courseCollapsed = 'card-collapsed';
    if($student->course_type!='' || $student->course_duration!='' || $student->status!='' || $student->batch_id!='' || $student->demo_date!='' || $student->enrollment_date!=''){
        $courseCollapsed = '';
    }
    #Check Address Detail Exist or not
    $addressCollapsed = 'card-collapsed';
    if($more->city!='' || $more->state!='' || $more->country!='' || $more->address!=''){
        $addressCollapsed = '';
    }
    #Check Another Detail Exist or not
    $anotherCollapsed = 'card-collapsed';
    if($student->dob!='' || $student->gender!='' || $student->passport!=''){
        $anotherCollapsed = '';
    }
    #Check Result Detail Exist or not
    $resultCollapsed = 'card-collapsed';
    if($result->test_date!='' || $result->test_result_date!='' || $result->overall_score!='' || $result->reading_score!='' || $result->writing_score!='' || $result->listening_score!='' || $result->speaking_score!='' || $result->trf!=''){
        $resultCollapsed = '';
    }
    $countryName = DB::table('countries')->where('id',$more->country)->first();
    $stateName = DB::table('states')->where('id',$more->state)->first();
    $cityName = DB::table('cities')->where('id',$more->city)->first();
@endphp
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Edit Student</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                    </ol>
                </div>
            </div>
            @if(Session::get('role')==1)
            <form method="post" action="{{route('admin.edit-student')}}" enctype="multipart/form-data">
                @else
            <form method="post" action="{{route('staff.edit-student')}}" enctype="multipart/form-data">
                @endif
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Basic Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="username" class="form-control" id="usernameInput" placeholder="Username" value="{{$user->username}}">
                                            <label for="usernameInput">Username</label>
                                        </div>
                                       @error('username')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input disabled type="email" name="email" class="form-control" id="emailInput" placeholder="Email" value="{{$user->email}}">
                                            <label for="emailInput">Email</label>
                                        </div>
                                        @error('email')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="father_name" name="father_name" class="form-control" id="fatherNameInput" placeholder="Father Name" value="{{$student->father_name}}">
                                            <label for="fatherNameInput">Father Name</label>
                                        </div>
                                        @error('father_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="mother_name" name="mother_name" class="form-control" id="motherNameInput" placeholder="Mother Name" value="{{$student->mother_name}}">
                                            <label for="motherNameInput">Mother Name</label>
                                        </div>
                                        @error('mother_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input disabled type="number" name="mobile" class="form-control number-without-arrow" id="mobileInput" placeholder="Mobile" value="{{$user->mobile}}">
                                            <label for="mobileInput">Mobile</label>
                                        </div>
                                        @error('mobile')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password">
                                            <label for="passwordInput">Kindly keep it blank if you don't want to change the password</label>
                                        </div>
                                        @error('password')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input class="form-control" name="profile_pic" type="file">
                                        @if($more->profile_pic!='')
                                        <a target="_blank" href="{{asset('assets/images/staff-students')}}/{{$more->profile_pic}}">
                                        <img class="profile-thumbnail mt-2" src="{{asset('assets/images/staff-students')}}/{{$more->profile_pic}}" alt="">
                                        </a>
                                        @endif
                                    </div>
                                    @error('profile_pic')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card {{$courseCollapsed}}">
                        <div class="card-header">
                            <h3 class="card-title">Course Details</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <select name="course_type" id="course_type" class="form-control">
                                                <option value="" hidden>Select Course Type</option>
                                                <option @if($student->course_type=='ielts') {{'selected'}} @endif value="ielts">IELTS</option>
                                                <option @if($student->course_type=='pte') {{'selected'}} @endif value="pte">PTE</option>
                                                <option @if($student->course_type=='spoken_english') {{'selected'}} @endif value="spoken_english">Spoken English</option>
                                            </select>
                                            </select>
                                        </div>
                                       @error('course_type')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <select name="course_duration" id="course_duration" class="form-control">
                                                <option value="" hidden>Select Course Duration</option>
                                                <option @if($student->course_duration=='1') {{'selected'}} @endif value="1">1 Month</option>
                                                <option @if($student->course_duration=='2') {{'selected'}} @endif value="2">2 Months</option>
                                                <option @if($student->course_duration=='3') {{'selected'}} @endif value="3">3 Months</option>
                                                <option @if($student->course_duration=='4') {{'selected'}} @endif value="4">4 Months</option>
                                                <option @if($student->course_duration=='5') {{'selected'}} @endif value="5">5 Months</option>
                                                <option @if($student->course_duration=='6') {{'selected'}} @endif value="6">6 Months</option>
                                            </select>
                                        </div>
                                       @error('course_duration')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <select name="student_status" id="student_status" class="form-control">
                                                <option value="" hidden>Student Status</option>
                                                <option @if($student->status=='demo class') {{'selected'}} @endif value="demo class">Demo class</option>
                                                <option @if($student->status=='enrolled') {{'selected'}} @endif value="enrolled">Enrolled</option>
                                                <option @if($student->status=='fees paid') {{'selected'}} @endif value="fees paid">Fees Paid</option>
                                                <option @if($student->status=='half fees paid') {{'selected'}} @endif value="half fees paid">Half Fees Paid</option>
                                                <option @if($student->status=='completed duration') {{'selected'}} @endif value="completed duration">Completed Duration</option>
                                                <option @if($student->status=='completed duration score achieved') {{'selected'}} @endif value="completed duration score achieved">Complete Duration (Score Achieved)</option>
                                            </select>
                                        </div>
                                       @error('student_status')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <select name="batch" id="batch" class="form-control">
                                                <option value="" hidden>Select Batch</option>
                                               @foreach ($batch as $b)
                                               @if($b->id == $student->batch_id)
                                                   <option selected value="{{$b->id}}">{{$b->name}}</option>
                                                   @else
                                                   <option value="{{$b->id}}">{{$b->name}}</option>
                                                   @endif
                                               @endforeach
                                                
                                            </select>
                                        </div>
                                       @error('batch')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div><input class="form-control fc-datepicker" placeholder="Demo class date" type="text" id="demo_class_date" value="{{$student->demo_date}}" name="demo_class_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div><input class="form-control fc-datepicker" placeholder="Enrollment date" type="text" id="enrollment_date" value="{{$student->enrollment_date}}" name="enrollment_date">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card {{$addressCollapsed}}">
                        <div class="card-header">
                            <h3 class="card-title">Address Information</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="form-label"> Country</label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="@isset($more->country) @if($countryName->name!='') {{$countryName->name}} @else {{'Choose One'}} @endif @endif" name="country" id="country-select">
                                            <option label="Choose one"></option>
                                            @foreach ($countries as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label"> State</label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="@isset($more->state) @if($stateName->name!='') {{$stateName->name}} @else {{'Choose One'}} @endif @endisset()" name="state" id="state-select">
                                            <option label="Choose one"></option>
                                            
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label"> City</label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="@isset($more->city) @if($cityName->name!='') {{$cityName->name}} @else {{'Choose one'}} @endif @endisset" name="city" id="city-select">
                                            <option label="Choose one"></option>
                                            
                                        </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-floating floating-label">
                                        <textarea name="address" class="form-control" placeholder="address"
                                            id="addressInput">{{$more->address}}</textarea>
                                        <label for="addressInput">Address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card {{$anotherCollapsed}}">
                        <div class="card-header">
                            <h3 class="card-title">Another Details</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div><input class="form-control fc-datepicker" placeholder="Date of Birth" value="{{$student->dob}}" type="text" id="dob" name="dob">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" hidden>Gender</option>
                                                <option @if($student->gender=='male') {{'selected'}} @endif value="male">Male</option>
                                                <option @if($student->gender=='female') {{'selected'}} @endif value="female">Female</option>
                                                <option @if($student->gender=='others') {{'selected'}} @endif value="others">Others</option>
                                                <option @if($student->gender=='rather_not_to_say') {{'selected'}} @endif value="rather_not_to_say">Rather not to say</option>
                                            </select>
                                        </div>
                                       @error('gender')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="possport">Passport</label>
                                        <input class="form-control" name="passport" id="passport" type="file">
                                        @if($student->passport!='')
                                        <a target="_blank" href="{{asset('assets/documents')}}/{{$student->passport}}" class="btn btn-green mt-2">
                                            <span>View <i class="fe fe-book-open"></i></span>
                                        </a>
                                        <a download target="_blank" href="{{asset('assets/documents')}}/{{$student->passport}}" class="btn btn-purple mt-2 ml-2">
                                            <span>Download <i class="fe fe-book-open"></i></span>
                                        </a>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card {{$resultCollapsed}}">
                        <div class="card-header">
                            <h3 class="card-title">Result Details</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div><input class="form-control fc-datepicker" placeholder="Test Date" type="text" value="{{$result->test_date}}" id="test_date" name="test_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div><input class="form-control fc-datepicker" placeholder="Test Result Date" type="text" id="test_result_date" value="{{$result->test_result_date}}" name="test_result_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" name="trf_no" placeholder="TRF No" class="form-control" value="{{$result->trf_no}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="overall_score" placeholder="Overall Score" class="form-control number-without-arrow" step="0.5" value="{{$result->overall_score}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="reading_score" placeholder="Reading Score" class="form-control number-without-arrow" step="0.5" value="{{$result->reading_score}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="writing_score" placeholder="Writing Score" class="form-control number-without-arrow" step="0.5" value="{{$result->writing_score}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="listening_score" placeholder="Listening Score" class="form-control number-without-arrow" step="0.5" value="{{$result->listening_score}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="speaking_score" placeholder="Speaking Score" class="form-control number-without-arrow" step="0.5" value="{{$result->speaking_score}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="trf">TRF</label>
                                        <input class="form-control" name="trf" id="trf" type="file">
                                        @if($result->trf!='')
                                        <a target="_blank" href="{{asset('assets/documents')}}/{{$result->trf}}" class="btn btn-green mt-2">
                                            <span>View <i class="fe fe-clipboard"></i></span>
                                        </a>
                                        <a download target="_blank" href="{{asset('assets/documents')}}/{{$result->trf}}" class="btn btn-purple mt-2 ml-2">
                                            <span>Download <i class="fe fe-clipboard"></i></span>
                                        </a>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="row">
            <div class="col-md-12 mb-2">
                <button type="submit" class="btn btn-success btn-lg"><i class="fe fe-check me-2"></i>Update</button>
            </div>
          </div>
        </form>
            <!-- /Row -->
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
<script  src="{{asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script  src="{{asset('assets/js/sweet-alert.js')}}"></script>
@if(Session::has('success'))
<script>
swal('Congratulations!', 'Student data updated successfully', 'success');
</script>
@endif
@endsection