@extends('layouts.main')
@section('title', 'Add Study Material')
@section('study_material', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Study Material</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Study Material</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Study Material</li>
                        </ol>
                    </div>
                </div>
                @if(Session::get('role')==1)
                <form method="post" action="{{ route('admin.add-study-material') }}" enctype="multipart/form-data">
                    @else
                <form method="post" action="{{ route('staff.add-study-material') }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Study Materials for Students</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="titleInput">Title</label>
                                                <input required type="text" name="title" class="form-control" id="titleInput"
                                                    placeholder="Choose title">
                                            @error('title')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="typeInput">Type</label>
                                                <input type="text" name="type" class="form-control" id="typeInput"
                                                    placeholder="Choose type">
                                            @error('type')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="forInput">For</label>
                                                <select required name="for" name="for" id="forInput" class="form-control">
                                                    <option value="" hidden>Choose for</option>
                                                    <option value="all">ALL</option>
                                                    <option value="ielts">IELTS</option>
                                                    <option value="pte">PTE</option>
                                                </select>
                                            </div>
                                            @error('for')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="descriptionInput">Description</label>
                                               <textarea name="description" id="descriptionInput" rows="4" class="form-control"></textarea>
                                            </div>
                                            @error('description')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input required class="form-control" name="file[]" multiple type="file">
                                        </div>
                                        @error('file')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
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
            swal('Congratulations!', 'Study material uploaded successfully', 'success');
        </script>
    @endif
@endsection
