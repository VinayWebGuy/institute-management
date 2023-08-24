@extends('layouts.main')
@section('title', 'Study Material')
@section('study_material', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Study Material</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Study Material</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">All Study Materials</h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="file" placeholder="Search file"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">Title</th>
                                                <th class="wd-15p border-bottom-0">Type</th>
                                                <th class="wd-12p border-bottom-0">File</th>
                                                <th class="wd-22p border-bottom-0">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($materials as $m)
                                                @php
                                                    #Break Files
                                                    $br_files = explode('|', $m->file);
                                                    $file_count = count($br_files);
                                                @endphp
                                                <tr>
                                                    <td>{{ ucfirst($m->title) }}</td>
                                                    <td>{{ ucfirst($m->type) }}</td>
                                                    <td>
                                                        @php
                                                            $x = 1;
                                                        @endphp
                                                        @foreach ($br_files as $f)
                                                            <a target="_blank"
                                                                href="{{ asset('assets/study_materials') }}/{{ $f }}"
                                                                class="btn btn-purple btn-block mb-1"><i
                                                                    class="fe fe-file mr-1"></i> File
                                                                {{ $x }}</a>
                                                            @php
                                                                $x++;
                                                            @endphp
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $m->description }}</td>
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
            swal('Congratulations!', 'Study Material deleted successfully', 'success');
        </script>
    @endif
@endsection
