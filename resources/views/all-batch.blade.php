@extends('layouts.main')
@section('title', 'All Batches')
@section('batch', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Batches</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Batch</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Batches</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Batch Data</h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="batch" placeholder="Search Batch"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">Name</th>
                                                <th class="wd-20p border-bottom-0">Start - End Date</th>
                                                <th class="wd-12p border-bottom-0">Session</th>
                                                <th class="wd-10p border-bottom-0">Assigned Staff</th>
                                                <th class="wd-17p border-bottom-0">From - To</th>
                                                <th class="wd-13p border-bottom-0">Status</th>
                                                <th class="wd-13p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($batch as $b)
                                                {{-- Another Table --}}
                                                @php
                                                   $user = DB::table('users')->where('id',$b->assigned_staff)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$b->name}}</td>
                                                    <td>{{$b->start_date}} - {{$b->end_date}}</td>
                                                    <td>
                                                        @if($b->morning_evening==1)
                                                        {{'Morning'}}
                                                        @elseif($b->morning_evening==2)
                                                        {{'Evening'}}
                                                        @else
                                                        {{'Unknown'}}
                                                        @endif
                                                    </td>
                                                    <td>@if($b->assigned_staff!='') {{$user->username}} @else {{'Unknown'}} @endif</td>
                                                    <td>{{$b->from_time}} - {{$b->to_time}}</td>
                                                    <td>
                                                        @if ($b->status == 1)
                                                            <a href="{{ url('admin/change-batch-status') }}/{{ $b->id }}"
                                                                class="btn btn-green">Active</a>
                                                        @else
                                                            <a href="{{ url('admin/change-batch-status') }}/{{ $b->id }}"
                                                                class="btn btn-red">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- <a class="btn btn-icon btn-red modal-effect deleteBatchModal"
                                                            data-id="{{ $b->id }}"
                                                            data-bs-effect="effect-super-scaled" data-bs-toggle="modal"
                                                            href="#deleteBatch"><i class="fe fe-trash"></i></a> --}}
                                                        <a href="{{ url('admin/edit-batch') }}/{{ $b->id }}"
                                                            class="btn btn-icon btn-cyan"><i class="fe fe-edit"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- CONTAINER CLOSED -->

        </div>
    </div>




    <div class="modal fade" id="deleteBatch">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Enter Secret Key to delete</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p id="batch-name-to-delete">Wait while we are loading...........</p>
                    <input type="hidden" name="" id="user-id-input" class="form-control">
                    <input type="password" disabled name="" id="key-to-delete"
                        class="form-control delete-modal-comp">
                    <button disabled class="btn btn-red btn-block mt-3 delete-modal-comp-2">Delete</button>
                    <span class="mt-1 text-danger modalError"></span>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Login Key</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6 id="login-key-area">Wait while we are loading...........</h6>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="copy-login-key" onclick="copyToClipboard()">Copy</button> <button
                        class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('deleted'))
        <script>
            swal('Congratulations!', 'Batch data deleted successfully', 'success');
        </script>
    @endif
@endsection
