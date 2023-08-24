@extends('layouts.main')
@section('title', 'All Help Blocks')
@section('help', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Help Blocks</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Help</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Help Blocks</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">All Help Blocks</h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="help" placeholder="Search Help"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">Title</th>
                                                <th class="wd-25p border-bottom-0">Description</th>
                                                <th class="wd-15p border-bottom-0">Category</th>
                                                <th class="wd-15p border-bottom-0">For</th>
                                                <th class="wd-15p border-bottom-0">Status</th>
                                                <th class="wd-15p border-bottom-0 d-flex">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($help as $h)
                                                @php
                                                       $title = (strlen($h->title) > 33) ? substr($h->title,0,30).'...' : $h->title;
                                                       $desc = (strlen($h->description) > 43) ? substr($h->description,0,40).'...' : $h->description;
                                                @endphp
                                                <tr>
                                                    <td>{{$title}}</td>
                                                    <td>{!! $desc !!}</td>
                                                    <td>{{ucfirst($h->category)}}</td>
                                                    <td>{{ucfirst($h->for)}}</td>
                                                    <td>
                                                        @if($h->status==1)
                                                        <a href="{{url('admin/change-help-block-status/0')}}/{{$h->id}}" class="btn btn-green">Active</a>
                                                        @else   
                                                        <a href="{{url('admin/change-help-block-status/1')}}/{{$h->id}}" class="btn btn-red">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a target="_blank" class="btn btn-icon btn-cyan"
                                                        href="{{url('admin/edit-help-block')}}/{{$h->id}}"><i class="fe fe-edit"></i></a>
                                                        <a class="btn btn-icon btn-red mx-1"
                                                        href="{{url('admin/delete-help-block')}}/{{$h->id}}"><i class="fe fe-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                    {{$help->links()}}
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




    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('deleted'))
        <script>
            swal('Congratulations!', 'Help Block deleted successfully', 'success');
        </script>
    @endif
    @if (Session::has('status'))
        <script>
            swal('Congratulations!', 'Status updated successfully', 'success');
        </script>
    @endif
@endsection
