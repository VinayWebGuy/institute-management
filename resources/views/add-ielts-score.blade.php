@extends('layouts.main')
@section('title', 'Add IELTS score')
@section('ielts', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add IELTS score</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">IELTS</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add IELTS socre</li>
                        </ol>
                    </div>
                </div>
                @if(Session::get('role')==1)
                <form method="post" action="{{route('admin.ielts.save-score')}}">
                    @else
                    <form method="post" action="{{route('staff.ielts.save-score')}}">
                    @endif
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    @isset($score)
                    <input type="hidden" name="score_id" value="{{$score->id}}">
                    @endisset
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add IELTS score of {{$user->username}}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="date">Date</label>
                                            <input @isset($score) {{'disabled'}} @endif type="date" name="date" id="date" value="@isset($date){{$date}}@endif" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="kind">Kind</label>
                                            <select name="kind" id="kind" class="form-control">
                                                <option @if(isset($score))  @if($score->kind=='Academic') {{'selected'}} @endif @else @if($kind=='Academic') {{'selected'}} @endif @endif value="Academic">Academic</option>
                                                <option @if(isset($score))  @if($score->kind=='General') {{'selected'}} @endif @else @if($kind=='General') {{'selected'}} @endif @endif value="General">General</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="type">Type</label>
                                            <select name="type" id="type" class="form-control">
                                                <option @if(isset($score))  @if($score->type=='Regular') {{'selected'}} @endif @else @if($type=='Regular') {{'selected'}} @endif @endif value="Regular">Regular</option>
                                                <option @if(isset($score))  @if($score->type=='Mock') {{'selected'}} @endif @else @if($type=='Mock') {{'selected'}} @endif @endif value="Mock">Mock</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="overall">Overall</label>
                                            <input max="9" type="number" name="overall" id="overall" class="number-without-arrow form-control" step="any" value="@isset($score){{$score->overall}}@endisset">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="reading">Reading</label>
                                            <input max="9" type="number" name="reading" id="reading" class="number-without-arrow form-control" step="any" value="@isset($score){{$score->reading}}@endisset">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="writing1">Writing task 1</label>
                                            <input max="9" type="number" name="writing1" id="writing1" class="number-without-arrow form-control" step="any" value="@isset($score){{$score->writing1}}@endisset">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="writing2">Writing task 2</label>
                                            <input max="9" type="number" name="writing2" id="writing2" class="number-without-arrow form-control" step="any" value="@isset($score){{$score->writing2}}@endisset">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="listening">Listening</label>
                                            <input max="9" type="number" name="listening" id="listening" class="number-without-arrow form-control" step="any" value="@isset($score){{$score->listening}}@endisset">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="speaking">Speaking</label>
                                            <input max="9" type="number" name="speaking" id="speaking" class="number-without-arrow form-control" step="any" value="@isset($score){{$score->speaking}}@endisset">
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
            swal('Congratulations!', 'Score updated successfully', 'success');
        </script>
    @endif
@endsection
