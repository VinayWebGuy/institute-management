@extends('layouts.main')
@section('title', 'Edit Staff')
@section('staff', 'active')
@section('content')
@php
    $more = DB::table('user_more')->where('user_id',$user->id)->first();
    $addressCollapsed = 'card-collapsed';
    $bankCollapsed = 'card-collapsed';
    if($more->city!='' || $more->state!='' || $more->country!='' || $more->address!=''){
        $addressCollapsed = '';
    }
    if($more->bank_name!='' || $more->account_name!='' || $more->account_number!='' || $more->ifsc!=''){
        $bankCollapsed = '';
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
                <h1 class="page-title">Edit Staff</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Staff</li>
                    </ol>
                </div>
            </div>
            <form method="post" action="{{route('admin.edit-staff')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Basic Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" value="{{$user->id}}">
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
                                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="Email" disabled value="{{$user->email}}">
                                            <label for="emailInput">Email</label>
                                        </div>
                                        @error('email')
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
                                            <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Keep it blank if you don'\t want to change">
                                            <label for="passwordInput">Keep it blank if you don't want to change</label>
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
                                    <select class="form-control select2-show-search form-select" data-placeholder="@isset($countryName) {{$countryName->name}} @else {{'Choose One'}} @endisset" name="country" id="country-select">
                                            <option label="Choose one"></option>
                                            @foreach ($countries as $c)
                                                <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label"> State </label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="@isset($stateName) {{$stateName->name}} @else {{'Choose One'}} @endisset" name="state" id="state-select">
                                            <option label="Choose one"></option>
                                            
                                        </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label"> City </label>
                                    <select class="form-control select2-show-search form-select" data-placeholder="@isset($cityName) {{$cityName->name}} @else {{'Choose one'}} @endisset" name="city" id="city-select">
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
                    <div class="card {{$bankCollapsed}}">
                        <div class="card-header">
                            <h3 class="card-title">Bank Details</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="row">
            <div class="col-md-12 mb-3">
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
swal('Congratulations!', 'Staff data updated successfully', 'success');
</script>
@endif
@endsection