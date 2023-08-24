@extends('layouts.main')
@section('title', 'Add Student')
@section('student', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Add Student</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Student</li>
                    </ol>
                </div>
            </div>
            @if(Session::get('role')==1)
            <form method="post" action="{{route('admin.add-student')}}" enctype="multipart/form-data">
                @else
            <form method="post" action="{{route('staff.add-student')}}" enctype="multipart/form-data">
                @endif
                @csrf
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
                                            <input type="text" name="username" class="form-control" id="usernameInput" placeholder="Username">
                                            <label for="usernameInput">Username</label>
                                        </div>
                                       @error('username')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email">
                                            <label for="emailInput">Email</label>
                                        </div>
                                        @error('email')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="father_name" name="father_name" class="form-control" id="fatherNameInput" placeholder="Father Name">
                                            <label for="fatherNameInput">Father Name</label>
                                        </div>
                                        @error('father_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="mother_name" name="mother_name" class="form-control" id="motherNameInput" placeholder="Mother Name">
                                            <label for="motherNameInput">Mother Name</label>
                                        </div>
                                        @error('mother_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="number" name="mobile" class="form-control number-without-arrow" id="mobileInput" placeholder="Mobile">
                                            <label for="mobileInput">Mobile</label>
                                        </div>
                                        @error('mobile')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password">
                                            <label for="passwordInput">Password</label>
                                        </div>
                                        @error('password')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input class="form-control" name="profile_pic" type="file">
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
                    <div class="card card-collapsed">
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
                                                <option value="ielts">IELTS</option>
                                                <option value="pte">PTE</option>
                                                <option value="spoken_english">Spoken English</option>
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
                                                <option value="1">1 Month</option>
                                                <option value="2">2 Months</option>
                                                <option value="3">3 Months</option>
                                                <option value="4">4 Months</option>
                                                <option value="5">5 Months</option>
                                                <option value="6">6 Months</option>
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
                                                <option value="demo class">Demo class</option>
                                                <option value="enrolled">Enrolled</option>
                                                <option value="fees paid">Fees Paid</option>
                                                <option value="half fees paid">Half Fees Paid</option>
                                                <option value="completed duration">Completed Duration</option>
                                                <option value="completed duration score achieved">Complete Duration (Score Achieved)</option>
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
                                                   <option value="{{$b->id}}">{{$b->name}}</option>
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
                                                </div><input class="form-control fc-datepicker" placeholder="Demo class date" type="text" id="demo_class_date" name="demo_class_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div><input class="form-control fc-datepicker" placeholder="Enrollment date" type="text" id="enrollment_date" name="enrollment_date">
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
                    <div class="card card-collapsed">
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
                                    <select class="form-control select2-show-search form-select" data-placeholder="Choose one" name="country" id="country-select">
                                            <option label="Choose one"></option>
                                            @foreach ($countries as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label"> State</label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="Choose one" name="state" id="state-select">
                                            <option label="Choose one"></option>
                                            
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label"> City</label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="Choose one" name="city" id="city-select">
                                            <option label="Choose one"></option>
                                            
                                        </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="form-floating floating-label">
                                        <textarea name="address" class="form-control" placeholder="address"
                                            id="addressInput"></textarea>
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
                    <div class="card card-collapsed">
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
                                                </div><input class="form-control fc-datepicker" placeholder="Date of Birth" type="text" id="dob" name="dob">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" hidden>Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="others">Others</option>
                                                <option value="rather_not_to_say">Rather not to say</option>
                                            </select>
                                        </div>
                                       @error('gender')
                                           <strong class="text-danger">{{$message}}</strong>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="possport">Passport</label>
                                        <input class="form-control" name="passport" id="passport" type="file">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card card-collapsed">
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
                                                </div><input class="form-control fc-datepicker" placeholder="Test Date" type="text" id="test_date" name="test_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-floating">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div><input class="form-control fc-datepicker" placeholder="Test Result Date" type="text" id="test_result_date" name="test_result_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="text" name="trf_no" placeholder="TRF No" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="overall_score" placeholder="Overall Score" class="form-control number-without-arrow" step="0.5">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="reading_score" placeholder="Reading Score" class="form-control number-without-arrow" step="0.5">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="writing_score" placeholder="Writing Score" class="form-control number-without-arrow" step="0.5">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="listening_score" placeholder="Listening Score" class="form-control number-without-arrow" step="0.5">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="number" name="speaking_score" placeholder="Speaking Score" class="form-control number-without-arrow" step="0.5">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="trf">TRF</label>
                                        <input class="form-control" name="trf" id="trf" type="file">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="row">
            <div class="col-md-12 mb-2">
                <button type="submit" class="btn btn-success btn-lg"><i class="fe fe-check me-2"></i>Save</button>
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
swal('Congratulations!', 'Student data added successfully', 'success');
</script>
@endif
@endsection