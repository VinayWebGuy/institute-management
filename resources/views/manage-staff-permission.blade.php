@extends('layouts.main')
@section('title', 'Manage Staff Permission')
@section('staff', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Manage Staff Permission</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Staff Permission</li>
                        </ol>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.permission') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Manage Permission of {{ $user->username }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Permission</label>
                                            @if(!isset($permission))
                                            <select required class="form-control select2" name="permission[]"
                                                data-placeholder="Choose Permission" multiple>
                                                <option selected value="Add Student">
                                                    Add Student
                                                </option>
                                                <option selected value="All Students">
                                                    All Students
                                                </option>
                                                <option selected value="Edit Student">
                                                    Edit Student
                                                </option>
                                                <option selected value="Change Password">
                                                    Change Password
                                                </option>
                                                <option selected value="Add Score">
                                                    Add Score
                                                </option>
                                                <option selected value="View Score Report">
                                                    View Score Report
                                                </option>
                                                <option selected value="Add Study Material">
                                                    Add Study Material
                                                </option>
                                                <option selected value="View Study Material">
                                                    View Study Material
                                                </option>
                                                <option selected value="Delete Study Material">
                                                    Delete Study Material
                                                </option>
                                                <option selected value="Reports">
                                                    Reports
                                                </option>
                                                <option selected value="Student Fees">
                                                    Student Fees
                                                </option>
                                                <option selected value="Student Attendance">
                                                    Student Attendance
                                                </option>
                                                <option selected value="Generate Login Key">
                                                    Generate Login Key
                                                </option>
                                                <option selected value="Add Enquiry">
                                                   Add Enquiry
                                                </option>
                                                <option selected value="View Enquiries">
                                                    View Enquiries
                                                </option>
                                            </select>
                                            @else
                                            @php
                                                #Break Permission
                                                $p = $permission->permission;
                                                $br_p = explode(',',$p);
                                            @endphp
                                            <select required class="form-control select2" name="permission[]"
                                            data-placeholder="Choose Permission" multiple>
                                            <option @if (in_array('Add Student', $br_p)) {{'selected'}} @endif value="Add Student">
                                                Add Student
                                            </option>
                                            <option @if (in_array('All Students', $br_p)) {{'selected'}} @endif value="All Students">
                                                All Students
                                            </option>
                                            <option @if (in_array('Edit Student', $br_p)) {{'selected'}} @endif value="Edit Student">
                                                Edit Student
                                            </option>
                                            <option @if (in_array('Change Password', $br_p)) {{'selected'}} @endif value="Change Password">
                                                Change Password
                                            </option>
                                            <option @if (in_array('Add Score', $br_p)) {{'selected'}} @endif value="Add Score">
                                                Add Score
                                            </option>
                                            <option @if (in_array('View Score Report', $br_p)) {{'selected'}} @endif value="View Score Report">
                                                View Score Report
                                            </option>
                                            <option @if (in_array('Add Study Material', $br_p)) {{'selected'}} @endif value="Add Study Material">
                                                Add Study Material
                                            </option>
                                            <option @if (in_array('View Study Material', $br_p)) {{'selected'}} @endif value="View Study Material">
                                                View Study Material
                                            </option>
                                            <option @if (in_array('Delete Study Material', $br_p)) {{'selected'}} @endif value="Delete Study Material">
                                                Delete Study Material
                                            </option>
                                            <option @if (in_array('Reports', $br_p)) {{'selected'}} @endif value="Reports">
                                                Reports
                                            </option>
                                            <option @if (in_array('Student Fees', $br_p)) {{'selected'}} @endif value="Student Fees">
                                                Student Fees
                                            </option>
                                            <option @if (in_array('Student Attendance', $br_p)) {{'selected'}} @endif value="Student Attendance">
                                                Student Attendance
                                            </option>
                                            <option @if (in_array('Generate Login Key', $br_p)) {{'selected'}} @endif value="Generate Login Key">
                                                Generate Login Key
                                            </option>
                                            <option @if (in_array('Add Enquiry', $br_p)) {{'selected'}} @endif value="Add Enquiry">
                                                Add Enquiry
                                            </option>
                                            <option @if (in_array('View Enquiries', $br_p)) {{'selected'}} @endif value="View Enquiries">
                                                View Enquiries
                                            </option>
                                        </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            @if(!isset($permission))
                            <button type="submit" class="btn btn-success btn-lg"><i
                                    class="fe fe-check me-2"></i>Save</button>
                            @else
                            <button type="submit" class="btn btn-success btn-lg"><i
                                class="fe fe-check me-2"></i>Update</button>
                            @endif
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
            swal('Congratulations!', 'Permissions updated successfully', 'success');
        </script>
    @endif
@endsection
