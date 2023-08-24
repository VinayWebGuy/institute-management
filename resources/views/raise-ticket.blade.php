@extends('layouts.main')
@section('title', 'Raise Ticket')
@section('ticket', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Raise Ticket</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Ticket</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Raise Ticket</li>
                        </ol>
                    </div>
                </div>
                @if(Session::get('role')==2)
                <form method="post" action="{{ route('staff.raise-ticket') }}" enctype="multipart/form-data">
                @elseif(Session::get('role')==3)
                <form method="post" action="{{ route('student.raise-ticket') }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Raise Ticket</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
                                            @error('title')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" rows="3" class="form-control">{{old('description')}}</textarea>
                                            @error('description')
                                            <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input class="form-control" multiple name="file[]" type="file">
                                        </div>
                                        @error('file')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
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
            swal('Congratulations!', 'Ticket Raised Successfully!', 'success');
        </script>
    @endif
@endsection
