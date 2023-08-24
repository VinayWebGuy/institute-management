@extends('layouts.main')
@section('title', 'View Enquiries')
@section('enquiry', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">View Enquiry</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Enquiries</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Enquiry</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">View Enquiry
                                    @if($e->type=="ielts" || $e->type=="pte")
                                        @if(Session::get('role')==1)
                                        <a href="{{ url('admin/download-english-enquiry') }}/{{ $e->id }}"
                                        class="btn btn-icon btn-purple text-light ml-3"><i class="fe fe-download"></i></a>
                                        @else
                                        <a href="{{ url('staff/download-english-enquiry') }}/{{ $e->id }}"
                                        class="btn btn-icon btn-purple text-light ml-3"><i class="fe fe-download"></i></a>
                                        @endif
                                    @elseif($e->type=="Study Visa" || $e->type=="Tourist Visa")
                                    @if(Session::get('role')==1)
                                        <a href="{{ url('admin/download-study-visa-enquiry') }}/{{ $e->id }}"
                                        class="btn btn-icon btn-purple text-light ml-3"><i class="fe fe-download"></i></a>
                                        @else
                                        <a href="{{ url('staff/download-study-visa-enquiry') }}/{{ $e->id }}"
                                        class="btn btn-icon btn-purple text-light ml-3"><i class="fe fe-download"></i></a>
                                        @endif
                                    @endif
                                </h3>
                              
                            </div>
                            <div class="card-body">
                                @if($e->type=="ielts" || $e->type=="pte")
                                    <div class="enquiry-report-item"><span>Branch</span><span>{{$e->branch}}</span></div>
                                    <div class="enquiry-report-item"><span>Type</span><span>{{strtoupper($e->type)}}</span></div>
                                    <div class="enquiry-report-item"><span>Name</span><span>{{$e->name}}</span></div>
                                    <div class="enquiry-report-item"><span>Email</span><span>{{$e->email}}</span></div>
                                    <div class="enquiry-report-item"><span>Address</span><span>{{$e->full_address}}</span></div>
                                    <div class="enquiry-report-item"><span>Highest Qualification</span><span>{{$e->highest_qualification_name}}</span></div>
                                    <div class="enquiry-report-item"><span>Highest Qualification Percent</span><span>{{$e->highest_qualification_percent}}</span></div>
                                    <div class="enquiry-report-item"><span>Highest Qualification Year</span><span>{{$e->highest_qualification_year}}</span></div>
                                @elseif($e->type=="Study Visa")
                                    <div class="enquiry-report-item"><span>Branch</span><span>{{$e->branch}}</span></div>
                                    <div class="enquiry-report-item"><span>Type</span><span>{{strtoupper($e->type)}}</span></div>
                                    <div class="enquiry-report-item"><span>Name</span><span>{{$e->name}}</span></div>
                                    <div class="enquiry-report-item"><span>Email</span><span>{{$e->email}}</span></div>
                                    <div class="enquiry-report-item"><span>Address</span><span>{{$e->full_address}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>10th</span><span>{{$e->tenth_name}}</span></div>
                                    <div class="enquiry-report-item"><span>10th start</span><span>{{$e->tenth_start}}</span></div>
                                    <div class="enquiry-report-item"><span>10th end</span><span>{{$e->tenth_end}}</span></div>
                                    <div class="enquiry-report-item"><span>10th percent</span><span>{{$e->tenth_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>12th</span><span>{{$e->twlefth_name}}</span></div>
                                    <div class="enquiry-report-item"><span>12th start</span><span>{{$e->twlefth_start}}</span></div>
                                    <div class="enquiry-report-item"><span>12th end</span><span>{{$e->twlefth_end}}</span></div>
                                    <div class="enquiry-report-item"><span>12th percent</span><span>{{$e->twlefth_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Bachelor</span><span>{{$e->bachelor_name}}</span></div>
                                    <div class="enquiry-report-item"><span>Bachelor start</span><span>{{$e->bachelor_start}}</span></div>
                                    <div class="enquiry-report-item"><span>Bachelor end</span><span>{{$e->bachelor_end}}</span></div>
                                    <div class="enquiry-report-item"><span>Bachelor percent</span><span>{{$e->bachelor_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Master</span><span>{{$e->master_name}}</span></div>
                                    <div class="enquiry-report-item"><span>Master start</span><span>{{$e->master_start}}</span></div>
                                    <div class="enquiry-report-item"><span>Master end</span><span>{{$e->master_end}}</span></div>
                                    <div class="enquiry-report-item"><span>Master percent</span><span>{{$e->master_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Diploma</span><span>{{$e->diploma_name}}</span></div>
                                    <div class="enquiry-report-item"><span>Diploma start</span><span>{{$e->diploma_start}}</span></div>
                                    <div class="enquiry-report-item"><span>Diploma end</span><span>{{$e->diploma_end}}</span></div>
                                    <div class="enquiry-report-item"><span>Diploma percent</span><span>{{$e->diploma_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Country of interest</span><span>{{$e->country_of_interest}}</span></div>
                                    <div class="enquiry-report-item"><span>Course of interest</span><span>{{$e->course_of_interest}}</span></div>
                                    <div class="enquiry-report-item"><span>Field of interest</span><span>{{$e->field_of_interest}}</span></div>
                                    <div class="enquiry-report-item"><span>Preferred location</span><span>{{$e->preferred_location}}</span></div>
                                    <div class="enquiry-report-item"><span>Intake</span><span>{{$e->intake}}</span></div>
                                    <div class="enquiry-report-item"><span>Done IELTS or PTE?</span><span>{{strtoupper($e->done_ielts_or_pte)}}</span></div>
                                    @if($e->done_ielts_or_pte!='nothing')
                                    <div class="enquiry-report-item"><span>Overall</span><span>{{$e->overall}}</span></div>
                                    <div class="enquiry-report-item"><span>Listening</span><span>{{$e->listening}}</span></div>
                                    <div class="enquiry-report-item"><span>Reading</span><span>{{$e->reading}}</span></div>
                                    <div class="enquiry-report-item"><span>Writing</span><span>{{$e->writing}}</span></div>
                                    <div class="enquiry-report-item"><span>Speaking</span><span>{{$e->speaking}}</span></div>
                                    @endif
                                     @elseif($e->type=="Tourist Visa")
                                    <div class="enquiry-report-item"><span>Branch</span><span>{{$e->branch}}</span></div>
                                    <div class="enquiry-report-item"><span>Type</span><span>{{strtoupper($e->type)}}</span></div>
                                    <div class="enquiry-report-item"><span>Name</span><span>{{$e->name}}</span></div>
                                    <div class="enquiry-report-item"><span>Email</span><span>{{$e->email}}</span></div>
                                    <div class="enquiry-report-item"><span>Address</span><span>{{$e->full_address}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>10th</span><span>{{$e->tenth_name}}</span></div>
                                    <div class="enquiry-report-item"><span>10th start</span><span>{{$e->tenth_start}}</span></div>
                                    <div class="enquiry-report-item"><span>10th end</span><span>{{$e->tenth_end}}</span></div>
                                    <div class="enquiry-report-item"><span>10th percent</span><span>{{$e->tenth_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>12th</span><span>{{$e->twlefth_name}}</span></div>
                                    <div class="enquiry-report-item"><span>12th start</span><span>{{$e->twlefth_start}}</span></div>
                                    <div class="enquiry-report-item"><span>12th end</span><span>{{$e->twlefth_end}}</span></div>
                                    <div class="enquiry-report-item"><span>12th percent</span><span>{{$e->twlefth_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Bachelor</span><span>{{$e->bachelor_name}}</span></div>
                                    <div class="enquiry-report-item"><span>Bachelor start</span><span>{{$e->bachelor_start}}</span></div>
                                    <div class="enquiry-report-item"><span>Bachelor end</span><span>{{$e->bachelor_end}}</span></div>
                                    <div class="enquiry-report-item"><span>Bachelor percent</span><span>{{$e->bachelor_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Master</span><span>{{$e->master_name}}</span></div>
                                    <div class="enquiry-report-item"><span>Master start</span><span>{{$e->master_start}}</span></div>
                                    <div class="enquiry-report-item"><span>Master end</span><span>{{$e->master_end}}</span></div>
                                    <div class="enquiry-report-item"><span>Master percent</span><span>{{$e->master_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Diploma</span><span>{{$e->diploma_name}}</span></div>
                                    <div class="enquiry-report-item"><span>Diploma start</span><span>{{$e->diploma_start}}</span></div>
                                    <div class="enquiry-report-item"><span>Diploma end</span><span>{{$e->diploma_end}}</span></div>
                                    <div class="enquiry-report-item"><span>Diploma percent</span><span>{{$e->diploma_percent}}</span></div>
                                    <hr>
                                    <div class="enquiry-report-item"><span>Country of interest</span><span>{{$e->country_of_interest}}</span></div>
                                    <div class="enquiry-report-item"><span>Course of interest</span><span>{{$e->course_of_interest}}</span></div>
                                    <div class="enquiry-report-item"><span>Field of interest</span><span>{{$e->field_of_interest}}</span></div>
                                    <div class="enquiry-report-item"><span>Preferred location</span><span>{{$e->preferred_location}}</span></div>
                                    <div class="enquiry-report-item"><span>Intake</span><span>{{$e->intake}}</span></div>
                                    <div class="enquiry-report-item"><span>Done IELTS or PTE?</span><span>{{strtoupper($e->done_ielts_or_pte)}}</span></div>
                                    @if($e->done_ielts_or_pte!='nothing')
                                    <div class="enquiry-report-item"><span>Overall</span><span>{{$e->overall}}</span></div>
                                    <div class="enquiry-report-item"><span>Listening</span><span>{{$e->listening}}</span></div>
                                    <div class="enquiry-report-item"><span>Reading</span><span>{{$e->reading}}</span></div>
                                    <div class="enquiry-report-item"><span>Writing</span><span>{{$e->writing}}</span></div>
                                    <div class="enquiry-report-item"><span>Speaking</span><span>{{$e->speaking}}</span></div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if(Session::get('role')==1)
                <form action="{{route('admin.update-enquiry')}}" method="post">
                    @else
                <form action="{{route('staff.update-enquiry')}}" method="post">
                    @endif
                    @csrf
                    <input type="hidden" name="id" value="{{$e->id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Enquiry Remarks and Status
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-md-12 mb-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="custom-switch form-switch me-5">
                                                <input type="radio" name="enquiry_status"
                                                    class="custom-switch-input enquiry_status_switch" value="0" @if($e->enquiry_status==0) {{'checked'}} @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Pending</span>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="custom-switch form-switch me-5">
                                                <input type="radio" name="enquiry_status"
                                                    class="custom-switch-input enquiry_status_switch" value="1" @if($e->enquiry_status==1) {{'checked'}} @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">In Progress</span>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="custom-switch form-switch me-5">
                                                <input type="radio" name="enquiry_status"
                                                    class="custom-switch-input enquiry_status_switch" value="2" @if($e->enquiry_status==2) {{'checked'}} @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Lead</span>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="custom-switch form-switch me-5">
                                                <input type="radio" name="enquiry_status"
                                                    class="custom-switch-input enquiry_status_switch" value="3" @if($e->enquiry_status==3) {{'checked'}} @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Terminated</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea name="enquiry_remarks" id="enquiry_remarks" class="form-control" placeholder="Remarks...">{{$e->enquiry_remarks}}</textarea>
                                </div>
                                <button class="btn btn-green">Update</button>
                            </div>
                        </div>
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
            swal('Congratulations!', 'Enquiry updated successfully', 'success');
        </script>
    @endif
@endsection
