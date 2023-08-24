@extends('layouts.main')
@section('title', 'All Staff')
@section('staff', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">All Staff</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Staff</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">Staff Data</h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="staff" placeholder="Search Staff"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                        <thead>
                                            <tr>
                                                <th class="wd-10p border-bottom-0">Username</th>
                                                <th class="wd-10p border-bottom-0">Email</th>
                                                <th class="wd-10p border-bottom-0">Mobile</th>
                                                <th class="wd-10p border-bottom-0">Password</th>
                                                <th class="wd-12p border-bottom-0">Profile Pic</th>
                                                <th class="wd-10p border-bottom-0">City</th>
                                                <th class="wd-12p border-bottom-0">Login Key</th>
                                                <th class="wd-13p border-bottom-0">Status</th>
                                                <th class="wd-13p border-bottom-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                {{-- Another Table --}}
                                                @php
                                                    $more = DB::table('user_more')
                                                        ->where('user_id', $user->id)
                                                        ->first();
                                                    $city = DB::table('cities')
                                                        ->where('id', $more->city)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->mobile }}</td>
                                                    <td>{{ $more->open_password }}</td>
                                                    <td>
                                                        @if ($more->profile_pic != '')
                                                            <a target="_blank"
                                                                href="{{ asset('assets/images/staff-students') }}/{{ $more->profile_pic }}">
                                                                <img src="{{ asset('assets/images/staff-students') }}/{{ $more->profile_pic }}"
                                                                    class="profile-thumbnail" alt="">
                                                            </a>
                                                        @else
                                                            <span
                                                                class="profile-thumbnail-text">{{ $user->username[0] }}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($more->city != '')
                                                            {{ $city->name }}
                                                        @else
                                                            Unknown
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="modal-effect btn btn-cyan d-grid mb-3 generateLoginKey"
                                                            data-bs-effect="effect-newspaper" data-bs-toggle="modal"
                                                            data-id="{{ $user->id }}" href="#modaldemo8">Generate Login
                                                            Key</a>
                                                    </td>
                                                    <td>
                                                        @if ($user->status == 1)
                                                            <a href="{{ url('admin/change-staff-status') }}/{{ $user->id }}"
                                                                class="btn btn-green">Active</a>
                                                        @else
                                                            <a href="{{ url('admin/change-staff-status') }}/{{ $user->id }}"
                                                                class="btn btn-red">Block</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-icon btn-red modal-effect deleteUserModal"
                                                            data-id="{{ $user->id }}"
                                                            data-bs-effect="effect-super-scaled" data-bs-toggle="modal"
                                                            href="#deleteStaff"><i class="fe fe-trash"></i></a>
                                                        <a href="{{ url('admin/edit-staff') }}/{{ $user->id }}"
                                                            class="btn btn-icon btn-cyan"><i class="fe fe-edit"></i></a>
                                                        <a href="{{ url('admin/manage-staff-permission') }}/{{ $user->unique_key }}"
                                                            class="btn btn-icon btn-blue"><i class="fe fe-shield"></i></a>
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




    <div class="modal fade" id="deleteStaff">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Enter Secret Key to delete</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p id="staff-name-to-delete">Wait while we are loading...........</p>
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
            swal('Congratulations!', 'Staff data deleted successfully', 'success');
        </script>
    @endif
@endsection
