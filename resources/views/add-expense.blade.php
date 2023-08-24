@extends('layouts.main')
@section('title', 'Add Expense')
@section('expense', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Expense</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Expense Manager</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Expense</li>
                        </ol>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.add-expense') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add a custom expense</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="what">Title</label>
                                            <input required type="text" name="what" id="what" class="form-control">
                                            @error('what')
                                                <strong class="text-danger">{{$message}}</strong>                                                
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="type">Type <i class="fa fa-question-circle" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Choose debit if you spent money somewhere else choose Credit" aria-label="Choose Debit if you spent money somewhere else choose Credit"></i></label>
                                            <select required name="type" id="type" class="form-control">
                                                <option value="">Choose type</option>
                                                <option value="debit">Debit</option>
                                                <option value="credit">Credit</option>
                                            </select>
                                            @error('type')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="value">Value </label>
                                            <input required type="number" name="value" id="value" class="form-control number-without-arrow">
                                            @error('value')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="added_on">Added on</label>
                                            <input required type="date" name="added_on" id="added_on" class="form-control">
                                            @error('added_on')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control"></textarea>
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
            swal('Congratulations!', 'Expense data added successfully', 'success');
        </script>
    @endif
@endsection
