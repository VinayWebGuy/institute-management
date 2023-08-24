@extends('layouts.main')
@section('title', 'Add Staff')
@section('staff', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Add Staff</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Staff</li>
                    </ol>
                </div>
            </div>
            <form method="post" action="{{route('admin.add-staff')}}" enctype="multipart/form-data">
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
                            <h3 class="card-title">Bank Details</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-dark"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-3">
                                        <div class="form-floating">
                                            <input name="bank_name" type="text" class="form-control" id="bankNameInput" placeholder="Bank Name">
                                            <label for="bankNameInput">Bank Name</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-floating">
                                            <input name="account_name" type="text" class="form-control" id="accNameInput" placeholder="Account Name">
                                            <label for="accNameInput">Account Name</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-floating">
                                            <input type="number" name="account_number" class="form-control number-without-arrow" id="accNumberInput" placeholder="Account number">
                                            <label for="accNumberInput">Account number</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="form-floating">
                                            <input type="text" name="ifsc" class="form-control" id="ifscInput" placeholder="IFSC Code">
                                            <label for="ifscInput">IFSC Code</label>
                                        </div>
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
swal('Congratulations!', 'Staff data added successfully', 'success');
</script>
@endif
@endsection