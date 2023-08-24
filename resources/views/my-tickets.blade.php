@extends('layouts.main')
@section('title', 'My Tickets')
@section('ticket', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">My Tickets</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Ticket</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Tickets</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">My Raised Tickets</h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="ticket" placeholder="Search Ticket"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-20p border-bottom-0">Title</th>
                                                <th class="wd-20p border-bottom-0">Description</th>
                                                <th class="wd-20p border-bottom-0">File</th>
                                                <th class="wd-20p border-bottom-0">Status</th>
                                                <th class="wd-20p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tickets as $ticket)
                                                @php
                                                    #Break Files
                                                    $br_files = explode('|', $ticket->file);
                                                    $file_count = count($br_files)-1;
                                                    $desc = (strlen($ticket->description) > 43) ? substr($ticket->description,0,40).'...' : $ticket->description;
                                                @endphp
                                                <tr>
                                                    <td>{{ ucfirst($ticket->title) }}
                                                    <br>
                                                <small>({{$ticket->unique_id}})</small></td>
                                                    <td>{{ $desc }}</td>
                                                    <td>

                                                        @for($x=0;$x<$file_count;$x++)
                                                            <a target="_blank"
                                                                href="{{ asset('assets/tickets') }}/{{ $br_files[$x] }}"
                                                                class="btn btn-purple btn-block mb-1"><i
                                                                    class="fe fe-file mr-1"></i> File
                                                                {{ $x+1 }}</a>
                                                        @endfor
                                                    </td>
                                                    <td>
                                                            @if ($ticket->status == 1)
                                                                <button class="btn btn-warning">Pending</button>
                                                            @elseif ($ticket->status == 2)
                                                            <button class="btn btn-primary">In Progress</button>
                                                            @elseif ($ticket->status == 3)
                                                            <button class="btn btn-danger">Closed</button>
                                                            @elseif ($ticket->status == 4)
                                                            <button class="btn btn-success">Resolved</button>
                                                            @endif
                                                    </td>
                                                    <td>
                                                        @if (Session::get('role') == 2)
                                                            <a target="_blank" class="btn btn-icon btn-cyan"
                                                                href="{{ url('staff/view-ticket') }}/{{ $ticket->unique_id }}"><i
                                                                    class="fe fe-eye"></i></a>
                                                        @elseif (Session::get('role') == 3)
                                                        <a target="_blank" class="btn btn-icon btn-cyan"
                                                        href="{{ url('student/view-ticket') }}/{{ $ticket->unique_id }}"><i
                                                            class="fe fe-eye"></i></a>
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
            swal('Congratulations!', 'Message', 'success');
        </script>
    @endif
@endsection
