@extends('layouts.main')
@section('title', 'Change Password')
@section('home', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Change Password</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </div>
                </div>
                <form method="post" action="{{ route('change-password') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Keep a strong password</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="old_password">Old Password</label>
                                            <input required type="password" name="old_password" id="old_password" class="form-control">
                                            @error('old_password')
                                                <strong class="text-danger">{{$message}}</strong>
                                                @enderror
                                                @if(Session::has('invalid'))
                                                <strong class="text-danger">{{Session::get('invalid')}}</strong>
                                                @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="password">New Password</label>
                                            <input required type="password" name="password" id="password" class="form-control">
                                            @error('password')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input required type="password" name="confirm_password" id="confirm_password" class="form-control">
                                            @error('confirm_password')
                                                <strong class="text-danger">{{$message}}</strong>
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
            swal('Congratulations!', 'Password changed successfully', 'success');
        </script>
    @endif
@endsection
