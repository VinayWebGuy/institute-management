@extends('layouts.main')
@section('title', '2FA')
@section('2fa', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">2FA</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">2FA</li>
                    </ol>
                </div>
            </div>
            <form method="post" action="{{route('2fa')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Two Factor Authentication</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <label for="two_factor_authentication" class="">Enable Two Factor Authentication</label>
                                    <div class="material-switch pull-right">
                                        <input id="two_factor_authentication" @if(isset($setting)) @if($setting->two_factor_authentication==1) {{'checked'}} @endif  @endif name="two_factor_authentication" value="1" type="checkbox">
                                        <label for="two_factor_authentication" class="label-danger"></label>
                                    </div>
                                </li>
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