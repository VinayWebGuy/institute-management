@extends('layouts.main')
@section('title', 'Add Staff Salary')
@section('staff', 'active')
@section('content')
    @php
        $salaryDet = DB::table('salary_details')
            ->where('user_id', $user->id)
            ->first();
            $months = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
    @endphp
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Staff Salary</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Salary</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Staff Salary</li>
                        </ol>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.add-staff-salary') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="salary_id" value="{{ $salaryDet->id }}">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Salary of {{ $user->username }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="valueInput">Value</label>
                                            <input required type="number" name="value"
                                                class="form-control number-without-arrow" id="valueInput"
                                                placeholder="Value"
                                                value="@isset($salaryDet->salary_amount){{ $salaryDet->salary_amount }}@endif">
                                            @error('value')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <label for="monthInput">Month</label>
                                                <select required class="form-control select2-show-search form-select"
                                                    data-placeholder="Choose Month" name="month" id="monthInput">
                                                    <option label="Choose Month"></option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            @error('month')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="dateInput">Date</label>
                                            <input required type="date" name="added_on" id="dateInput" class="form-control">
                                            @error('added_on')
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
                                    class="fe fe-check me-2"></i>Save</button>
                        </div>
                    </div>
                </form>
             <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent added salaries</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-350p border-bottom-0">Value</th>
                                    <th class="wd-35p border-bottom-0">Added on</th>
                                    <th class="wd-20p border-bottom-0">Month</th>
                                    <th class="wd-10p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @isset($salaries)
                                @foreach($salaries as $s)
                                    <tr>
                                        <td>{{$s->value}}</td>
                                        <td>{{$s->added_on}}</td>
                                        <td>{{$months[$s->month]}}</td>
                                        <td>   <a href="{{ url('admin/edit-staff-salary') }}/{{$user->unique_key}}/{{ $s->id }}"
                                            class="btn btn-icon btn-cyan"><i class="fe fe-edit"></i></a></td>
                                    </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
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
    @if (Session::has('success'))
        <script>
            swal('Congratulations!', 'Salary updated successfully', 'success');
        </script>
    @endif
@endsection
