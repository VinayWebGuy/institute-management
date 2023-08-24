@extends('layouts.main')
@section('title', 'Expense Manager')
@section('expense', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Expense Manager</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Expense Manager</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8"><a href="{{url('admin/add-expense')}}" class="btn btn-green add-btnn">Add Expense +</a></h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="expense" placeholder="Search"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-25p border-bottom-0">Title</th>
                                                <th class="wd-40p border-bottom-0">Description</th>
                                                <th class="wd-15p border-bottom-0">Value</th>
                                                <th class="wd-15p border-bottom-0">Type</th>
                                                <th class="wd-5p border-bottom-0">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($expenses as $exp)
                                                    <tr>
                                                        <td>{{$exp->what}}</td>
                                                        <td>{{$exp->description}}</td>
                                                        <td>{{$exp->value}}</td>
                                                        <td>
                                                            @if($exp->type=='credit')
                                                            <span class="badge bg-green">Credit</span>
                                                            @else
                                                            <span class="badge bg-red">Debit</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$exp->added_on}}</td>
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
