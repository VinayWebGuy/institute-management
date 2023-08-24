@extends('layouts.main')
@section('title', 'Profile')
@section('home', 'active')
@section('content')
@php
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
                    <h1 class="page-title">Profile</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </div>
                </div>
                @if(Session::get('role')==2)
                <form method="post" action="{{ route('staff.profile') }}" enctype="multipart/form-data">
                    @elseif(Session::get('role')==3)
                    <form method="post" action="{{ route('student.profile') }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">My Profile</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <input class="form-control" name="profile_pic" type="file">
                                            @if($more->profile_pic!='')
                                            <a target="_blank" href="{{asset('assets/images/staff-students')}}/{{$more->profile_pic}}">
                                            <img class="profile-thumbnail mt-2" src="{{asset('assets/images/staff-students')}}/{{$more->profile_pic}}" alt="">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" value="@isset($user->username){{$user->username}}@endisset">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">Email <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Email can't be updated" aria-label="Email can't be updated"></i></label>
                                            <input disabled type="email" name="email" id="email" class="form-control" value="@isset($user->email){{$user->email}}@endisset">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mobile">Mobile <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Mobile number can't be updated" aria-label="Mobile number can't be updated"></i></label>
                                            <input disabled type="number" name="mobile" id="mobile" class="form-control number-without-arrow" value="@isset($user->mobile){{$user->mobile}}@endisset">
                                        </div>
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
                                        @if(Session::get('role')==2)
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <input name="bank_name" type="text" class="form-control" id="bankNameInput" placeholder="Bank Name" value="{{$more->bank_name}}">
                                                <label for="bankNameInput">Bank Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <input name="account_name" type="text" class="form-control" id="accNameInput" placeholder="Account Name" value="{{$more->account_name}}">
                                                <label for="accNameInput">Account Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <input type="number" name="account_number" class="form-control number-without-arrow" id="accNumberInput" placeholder="Account number" value="{{$more->account_number}}">
                                                <label for="accNumberInput">Account number</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="form-floating">
                                                <input type="text" name="ifsc" class="form-control" id="ifscInput" placeholder="IFSC Code" value="{{$more->ifsc}}">
                                                <label for="ifscInput">IFSC Code</label>
                                            </div>
                                        </div>
                                        @endif
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
                <!-- /Row -->
            </div>
            <!-- CONTAINER CLOSED -->

        </div>
    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Profile updated successfully', 'success');
        </script>
    @endif
@endsection
