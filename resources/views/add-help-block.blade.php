@extends('layouts.main')
@section('title', 'Add Help')
@section('help', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Help Block</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Help</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Help Block</li>
                        </ol>
                    </div>
                </div>
                    <form method="post" action="{{ route('admin.help') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Help Block</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ old('title') }}">
                                        @error('title')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                        @error('description')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="" hidden>Choose Category</option>
                                            <option value="login">Login</option>
                                            <option value="admin">Admin</option>
                                            <option value="student">Student</option>
                                            <option value="staff">Staff</option>
                                            <option value="dashboard">Dashboard</option>
                                            <option value="ticket">Ticket</option>
                                            <option value="report">Report</option>
                                            <option value="score">Score</option>
                                            <option value="profile">Profile</option>
                                            <option value="password">Password</option>
                                            <option value="theme">Theme</option>
                                            <option value="lockscreen">Lockscreen</option>
                                            <option value="calendar">Calendar</option>
                                            <option value="batch">Batch</option>
                                            <option value="study_material">Study Material</option>
                                            <option value="enquiry">Enquiry</option>
                                            <option value="notification">Notification</option>
                                            <option value="club">Club</option>
                                            <option value="discussion_hub">Discussion Hub</option>
                                            <option value="2fa">2FA</option>
                                            <option value="settings">Settings</option>
                                            <option value="expense_manager">Expense Mananger</option>
                                        </select>
                                        @error('category')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="for">For</label>
                                        <select name="for" id="for" class="form-control">
                                            <option value="all">All</option>
                                            <option value="admin">Admin</option>
                                            <option value="staff">Staff</option>
                                            <option value="students">Students</option>
                                        </select>
                                        @error('for')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="link">Any Link</label>
                                        <input type="text" name="link" id="link" class="form-control"
                                            value="{{ old('link') }}">
                                        @error('link')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
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
                <!-- /Row -->
            </div>
            <!-- CONTAINER CLOSED -->

        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/28x7zxg1njxohj41sctat1dhkscpk3x70uluko2s222zr360/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
        <script>
            tinymce.init({
              selector: 'textarea',
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
              tinycomments_mode: 'embedded',
              tinycomments_author: 'Author name',
              mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
              ]
            });
          </script>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Help Block Added Successfully!', 'success');
        </script>
    @endif
@endsection
