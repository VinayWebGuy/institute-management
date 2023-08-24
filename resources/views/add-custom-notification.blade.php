@extends('layouts.main')
@section('title', 'Add Custom Notification')
@section('custom-notification', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Custom Notification</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Custom Notification</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Custom Notification</li>
                        </ol>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.add-custom-notification') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Custom Notification</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title') }}">
                                            @error('title')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                            @error('description')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="custom-switch form-switch me-5">
                                                        <input checked type="radio" name="notification_for"
                                                            class="custom-switch-input notification_for_switch"
                                                            value="1">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Everyone</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-switch form-switch me-5">
                                                        <input type="radio" name="notification_for"
                                                            class="custom-switch-input notification_for_switch"
                                                            value="2">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">All Staff</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-switch form-switch me-5">
                                                        <input type="radio" name="notification_for"
                                                            class="custom-switch-input notification_for_switch"
                                                            value="3">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">All Students</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="custom-switch form-switch me-5">
                                                        <input type="radio" name="notification_for"
                                                            class="custom-switch-input notification_for_switch"
                                                            value="4">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Select from List</span>
                                                    </label>
                                                </div>
                                                @error('notification_for')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 d-none" id="notification-user-list">
                                            <label class="form-label">Users</label>
                                            <select class="form-control select2" name="user[]"
                                                data-placeholder="Select User" multiple>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->username }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <button type="submit" class="btn btn-success btn-lg"><i
                                    class="fe fe-check me-2"></i>Proceed</button>
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
            swal('Congratulations!', 'Notification Added Successfully!', 'success');
        </script>
    @endif
@endsection
