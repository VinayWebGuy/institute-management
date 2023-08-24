@extends('layouts.main')
@section('title', 'Settings')
@section('settings', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Settings</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </div>
            </div>
            <form method="post" action="{{route('settings')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Settings</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group col-md-12 p0">
                                <select name="by_default_home" id="" class="form-control">
                                    <option value="">Select Page</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='home') {{'selected'}} @endif  value="home">Home</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='calendar') {{'selected'}} @endif  value="calendar">Calendar</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='theme-customizer') {{'selected'}} @endif  value="theme-customizer">Theme Customizer</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='settings') {{'selected'}} @endif  value="settings">Settings</option>
                                    @if(Session::get('role')==1 || Session::get('role')==2)
                                    <option @if(isset($setting) && $setting->by_default_home=='add-student') {{'selected'}} @endif  value="add-student">Add student </option>
                                    <option @if(isset($setting) && $setting->by_default_home=='all-students') {{'selected'}} @endif  value="all-students">All students</option>
                                    @endif
                                    @if(Session::get('role')==1)
                                    <option @if(isset($setting) && $setting->by_default_home=='add-staff') {{'selected'}} @endif  value="add-staff">Add staff </option>
                                    <option @if(isset($setting) && $setting->by_default_home=='all-staff') {{'selected'}} @endif  value="all-staff">All staff</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='add-batch') {{'selected'}} @endif  value="add-batch">Add batch</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='all-batch') {{'selected'}} @endif  value="all-batch">All batch</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='manage-staff-salary') {{'selected'}} @endif  value="manage-staff-salary">Staff Salary</option>
                                    <option @if(isset($setting) && $setting->by_default_home=='manage-staff-attendance') {{'selected'}} @endif  value="manage-staff-attendance">Staff Attendance</option>
                                    @endif
                                </select>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <label for="show_notifications" class=""> Show Notifications</label>
                                    <div class="material-switch pull-right">
                                        <input id="show_notifications" @if(isset($setting)) @if($setting->show_notifications==1) {{'checked'}} @endif  @endif name="show_notifications" value="1" type="checkbox">
                                        <label for="show_notifications" class="label-primary"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <label for="enable_lockscreen" class=""> Enable Lockscreen</label>
                                    <div class="material-switch pull-right">
                                        <input id="enable_lockscreen" @if(isset($setting)) @if($setting->enable_lockscreen==1) {{'checked'}} @endif  @endif  name="enable_lockscreen" value="1" type="checkbox">
                                        <label for="enable_lockscreen" class="label-success"></label>
                                    </div>
                                </li>
                                {{-- <li class="list-group-item">
                                    Bootstrap Switch Info
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionInfo" name="someSwitchOption001" type="checkbox">
                                        <label for="someSwitchOptionInfo" class="label-info"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Bootstrap Switch Warning
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionWarning" name="someSwitchOption001" type="checkbox">
                                        <label for="someSwitchOptionWarning" class="label-warning"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Bootstrap Switch Danger
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionDanger" name="someSwitchOption001" type="checkbox">
                                        <label for="someSwitchOptionDanger" class="label-danger"></label>
                                    </div>
                                </li> --}}
                            </ul>
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
swal('Congratulations!', 'Settings updated successfully', 'success');
</script>
@endif
@endsection