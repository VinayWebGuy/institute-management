@extends('layouts.main')
@section('title', 'View Ticket')
@section('ticket', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">View Ticket <em>({{ $ticket->unique_id }})</em></h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Ticket</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Ticket</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    @php
                        #Break Files
                        $br_files = explode('|', $ticket->file);
                        $file_count = count($br_files) - 1;
                    @endphp
                    <div class="card">
                        <div class="card-body ticket-body">
                            <div class="row">
                                <h3 class="col-md-8">{{ $ticket->title }}</h3>
                                @if (Session::get('role') == 1)
                                    <input type="hidden" id="ticket-id" value="{{ $ticket->unique_id }}">
                                    <div class="row col-md-4">
                                        <select id="ticket-status" class="form-control col-md-8">
                                            <option @if ($ticket->status == 1) {{ 'selected' }} @endif
                                                value="1">Pending</option>
                                            <option @if ($ticket->status == 2) {{ 'selected' }} @endif
                                                value="2">In Progress</option>
                                            <option @if ($ticket->status == 3) {{ 'selected' }} @endif
                                                value="3">Closed</option>
                                            <option @if ($ticket->status == 4) {{ 'selected' }} @endif
                                                value="4">Resolved</option>
                                        </select>
                                        <button class="btn btn-cyan col-md-3 mx-2" id="update-ticket-status">Update</button>
                                    </div>
                                @else
                                    @if ($ticket->status == 1)
                                        <button class="btn btn-warning col-md-4">Pending</button>
                                    @elseif ($ticket->status == 2)
                                        <button class="btn btn-primary col-md-4">In Progress</button>
                                    @elseif ($ticket->status == 3)
                                        <button class="btn btn-danger col-md-4">Closed</button>
                                    @elseif ($ticket->status == 4)
                                        <button class="btn btn-success col-md-4">Resolved</button>
                                    @endif
                                @endif
                            </div>
                            <p>{{ $ticket->description }}</p>
                            <div>
                                @for ($x = 0; $x < $file_count; $x++)
                                    <a target="_blank" href="{{ asset('assets/tickets') }}/{{ $br_files[$x] }}"
                                        class="btn btn-purple mb-1 mr-2"><i class="fe fe-file mr-1"></i> File
                                        {{ $x + 1 }}</a>
                                @endfor
                            </div>
                            <div class="ticket-time">
                                <strong>{{ $ticket->created_at->diffForHumans() }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($comments as $comment)
                    <div class="row">
                        @php
                            #Break Files
                            $br_c_files = explode('|', $comment->file);
                            $file_c_count = count($br_c_files) - 1;
                            $u = DB::table('users')
                                ->where('id', $comment->from)
                                ->first();
                        @endphp
                        <div class="card">
                            <div class="card-header">
                                @if ($comment->from == Session::get('id'))
                                    <h4 class="comment-details">
                                        <strong>Comment Added by You</strong>
                                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                                    </h4>
                                @else
                                    <h4 class="comment-details">
                                        <strong>Comment Added by {{ $u->email }}</strong>
                                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                                    </h4>
                                @endif
                            </div>
                            <div class="card-body">
                                <p>{{ $comment->description }}</p>
                                <div>
                                    @for ($x = 0; $x < $file_c_count; $x++)
                                        <a target="_blank" href="{{ asset('assets/tickets') }}/{{ $br_c_files[$x] }}"
                                            class="btn btn-purple mb-1 mr-2"><i class="fe fe-file mr-1"></i> File
                                            {{ $x + 1 }}</a>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($ticket->status==1 || $ticket->status==2)
                @if (Session::get('role') == 2)
                    <form method="post" action="{{ route('staff.add-ticket-comment') }}" enctype="multipart/form-data">
                    @elseif(Session::get('role') == 3)
                        <form method="post" action="{{ route('student.add-ticket-comment') }}"
                            enctype="multipart/form-data">
                        @elseif(Session::get('role') == 1)
                            <form method="post" action="{{ route('admin.add-ticket-comment') }}"
                                enctype="multipart/form-data">
                @endif
                @csrf
                <input type="hidden" name="unique_id" value="{{ $ticket->unique_id }}">
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Comment</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="description">Comment</label>
                                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                        @error('description')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input class="form-control" multiple name="file[]" type="file">
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
                                class="fe fe-check me-2"></i>Proceed</button>
                    </div>
                </div>
                </form>
                @endif
                <!-- /Row -->
            </div>
            <!-- CONTAINER CLOSED -->

        </div>
    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Comment Added Successfully!', 'success');
        </script>
    @endif
    @if (Session::has('status'))
        <script>
            swal('Congratulations!', 'Status Updated Successfully!', 'success');
        </script>
    @endif
@endsection
