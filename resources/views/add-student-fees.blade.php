@extends('layouts.main')
@section('title', 'Add Student Fees')
@section('student', 'active')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Student Fees</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Student</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Student Fees</li>
                        </ol>
                    </div>
                </div>
                @if(Session::get('role')==1)
                <form method="post" action="{{ route('admin.add-student-fees') }}" enctype="multipart/form-data">
                    @else
                <form method="post" action="{{ route('staff.add-student-fees') }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add fees of {{ $user->username }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="fee-blocks">
                                        @if(isset($fees))
                                           @php $rows = $fees->rows;
                                            $x = 0;
                                            $br_fees = explode('|',$fees->fees);
                                            $br_received = explode('|',$fees->fee_received_date);
                                            $br_due= explode('|',$fees->next_due_date);
                                            @endphp
                                            @for($i=1;$i<=$rows;$i++)
                                            <div class="fee-block-{{$i}} row">
                                                <div class="form-group col-md-2">
                                                    <label for="feesInput">Fees Received</label>
                                                    <input required type="number" name="fees[]"
                                                        class="form-control number-without-arrow" id="feesInput"
                                                        placeholder="Fees" value="{{$br_fees[$x]}}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="receivedDateInput">Fees Received Date</label>
                                                    <input type="date" name="fee_received_date[]" class="form-control "
                                                        id="receivedDateInput" placeholder="Fees" value="{{$br_received[$x]}}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="dueDateInput">Next Due Date</label>
                                                    <input type="date" name="next_due_date[]" class="form-control "
                                                        id="dueDateInput" placeholder="Fees" value="{{$br_due[$x]}}">
                                                </div>

                                                <div class="col-md-2 form-group">
                                                    <label for="">Remove</label><br/>
                                                    <button type="button" disabled class="btn btn-red btn-block">
                                                        <i class="fe fe-x-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @php $x++; @endphp
                                            @endfor
                                        @else
                                            <div class="fee-block-1 row">
                                                <div class="form-group col-md-2">
                                                    <label for="feesInput">Fees Received</label>
                                                    <input required type="number" name="fees[]"
                                                        class="form-control number-without-arrow" id="feesInput"
                                                        placeholder="Fees">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="receivedDateInput">Fees Received Date</label>
                                                    <input type="date" name="fee_received_date[]" class="form-control "
                                                        id="receivedDateInput" placeholder="Fees">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="dueDateInput">Next Due Date</label>
                                                    <input type="date" name="next_due_date[]" class="form-control "
                                                        id="dueDateInput" placeholder="Fees">
                                                </div>

                                                <div class="col-md-2 form-group">
                                                    <label for="">Remove</label><br/>
                                                    <button type="button" disabled class="btn btn-red btn-block">
                                                        <i class="fe fe-x-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-purple" id="add-fee-block"
                                                data-btn="@if(isset($fees)){{($rows+1)}}@else{{'2'}}@endif">Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <button type="submit" class="btn btn-success btn-lg"><i
                                    class="fe fe-check me-2"></i>Save</button>
                        </div>
                    </div>
                </form>
                <!-- /Row -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Fees updated successfully', 'success');
        </script>
    @endif
@endsection
