@extends('layouts.main')
@section('title', 'All Enquiries')
@section('enquiry', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Enquiries</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Enquiries</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Enquiries</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Al Enquiries</h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="enquiry" placeholder="Search Enquiry"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-7p border-bottom-0">Branch</th>
                                                <th class="wd-9p border-bottom-0">Name</th>
                                                <th class="wd-10p border-bottom-0">Email</th>
                                                <th class="wd-10p border-bottom-0">Mobile</th>
                                                <th class="wd-10p border-bottom-0">Reference</th>
                                                <th class="wd-15p border-bottom-0">Type</th>
                                                <th class="wd-20p border-bottom-0">Country</th>
                                                <th class="wd-15p border-bottom-0 d-flex">Action 
                                                    <div class="material-switch ml-3" style="margin-left:15px !important;margin-top:3px !important">
                                                        <input value="1" id="allow-delete" name="" type="checkbox">
                                                        <label for="allow-delete" class="label-danger"></label>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($enquiries as $e)
                                                <tr>
                                                    <td>{{$e->branch}}</td>
                                                    <td>{{$e->name}}</td>
                                                    <td>{{$e->email}}</td>
                                                    <td>{{$e->mobile}}</td>
                                                    <td>{{$e->reference}}</td>
                                                    <td>{{strtoupper($e->type)}}</td>
                                                    <td>
                                                        <?php
                                                            if(isset($e->country_of_interest)){
                                                                // Break Country
                                                                $br_country = explode(',',$e->country_of_interest);
                                                                $colors = ['primary','success','info','warning','danger','secondary','primary','success','info','warning','danger','secondary'];
                                                                $i = 0;
                                                                foreach ($br_country as $c) {   ?>
                                                                   <span class="badge bg-{{$colors[$i]}}-gradient badge-sm  me-1 mb-1 mt-1">{{$c}}</span><br>
                                                                <?php $i++; }
                                                            }
                                                       ?>
                                                    </td>
                                                    <td>
                                                        @if(Session::get('role')==1)
                                                        <a href="{{ url('admin/view-enquiry') }}/{{ $e->id }}"
                                                            class="btn btn-icon btn-cyan"><i class="fe fe-eye"></i></a>
                                                        <a href="{{ url('admin/delete-enquiry') }}/{{ $e->id }}"
                                                            class="btn btn-icon btn-red delete-btn hidden"><i class="fe fe-trash"></i></a>
                                                            @else
                                                        <a href="{{ url('staff/view-enquiry') }}/{{ $e->id }}"
                                                            class="btn btn-icon btn-cyan"><i class="fe fe-eye"></i></a>
                                                        <a href="{{ url('staff/delete-enquiry') }}/{{ $e->id }}"
                                                            class="btn btn-icon btn-red delete-btn hidden"><i class="fe fe-trash"></i></a>
                                                            @endif
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




    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('deleted'))
        <script>
            swal('Congratulations!', 'Enquiry deleted successfully', 'success');
        </script>
    @endif
@endsection
