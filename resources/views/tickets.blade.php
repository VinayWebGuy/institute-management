@extends('layouts.main')
@section('title', 'Tickets')
@section('ticket', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Tickets</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tickets</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                @if($type=='')
                                <h3 class="card-title col-md-8">All Tickets</h3>

                                @endif
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="ticket" placeholder="Search Ticket"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="tickets-type-blocks">
                                    <a href="{{url('admin/tickets')}}" class="btn @if($type=='')  btn-primary @else btn-outline-primary @endif">All</a>
                                    <a href="{{url('admin/tickets/pending')}}" class="btn @if($type=='pending')  btn-warning @else btn-outline-warning @endif">Pending</a>
                                    <a href="{{url('admin/tickets/progress')}}" class="btn @if($type=='progress') btn-info @else btn-outline-info @endif ">In Progress</a>
                                    <a href="{{url('admin/tickets/closed')}}" class="btn @if($type=='closed') btn-danger @else btn-outline-danger @endif">Closed</a>
                                    <a href="{{url('admin/tickets/resolved')}}" class="btn @if($type=='resolved') btn-success @else btn-outline-success @endif">Resolved</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-20p border-bottom-0">Title</th>
                                                <th class="wd-20p border-bottom-0">Description</th>
                                                <th class="wd-20p border-bottom-0">File</th>
                                                <th class="wd-10p border-bottom-0">Added By</th>
                                                <th class="wd-20p border-bottom-0">Status</th>
                                                <th class="wd-10p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tickets as $ticket)
                                                @php
                                                    #Break Files
                                                    $br_files = explode('|', $ticket->file);
                                                    $file_count = count($br_files)-1;
                                                    $desc = (strlen($ticket->description) > 43) ? substr($ticket->description,0,40).'...' : $ticket->description;
                                                    $user = DB::table('users')->where('id',$ticket->user_id)->first();
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
                                                    <td>{{$user->email}}</td>
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
                                                            <a target="_blank" class="btn btn-icon btn-cyan"
                                                                href="{{ url('admin/view-ticket') }}/{{ $ticket->unique_id }}"><i
                                                                    class="fe fe-eye"></i></a>
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
