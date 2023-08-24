@extends('layouts.main1')
@section('title', 'Add Enquiry')
@section('content')
    @php
        $selected = false;
        if (isset($type) && isset($branch)) {
            $selected = true;
        }
    @endphp
    <div class="main-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Add Enquiry</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Enquiry</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Enquiry</li>
                        </ol>
                    </div>
                </div>
                @if ($selected)
                        <form method="post" action="{{ route('addUniversalEnquiry') }}" enctype="multipart/form-data">
                    @csrf
                @endif
                @if (!$selected)
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Select Enquiry Type and Branch</h3>
                                </div>
                                <div class="card-body">
                                    <form method="get">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <select required name="type" id="type" class="form-control">
                                                    <option value="">Choose Enquiry Type
                                                    <option value="Study Visa">Study Visa</option>
                                                    <option value="Tourist Visa">Tourist Visa</option>
                                                    <option value="IELTS">IELTS</option>
                                                    <option value="PTE">PTE</option>
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <select required name="branch" id="branch" class="form-control">
                                                    <option disabled value="">Choose Branch</option>
                                                    <option selected value="Nilokheri">Nilokheri</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-green">Proceed</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($selected && $type == 'IELTS')
                    <input type="hidden" name="type" value="ielts">
                    <input type="hidden" name="branch" value="{{$branch}}">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                       
                                            <a href="{{ url('add-universal-enquiry') }}" class="mr-2 text-red">
                                                <i class="fe fe-corner-up-left"></i>
                                            </a>
                                        IELTS ENQUIRY
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="number" class="form-control number-without-arrow" name="mobile" required
                                                id="mobile">
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="reference">Reference</label>
                                            <input type="text" class="form-control" name="reference" id="reference">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="full_address">Address</label>
                                            <textarea name="full_address" id="full_address" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="highest_qualification_name">High Qualification Name</label>
                                            <input type="text" class="form-control" name="highest_qualification_name"
                                                id="highest_qualification_name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="highest_qualification_percent">High Qualification Percent</label>
                                            <input type="text" class="form-control" name="highest_qualification_percent"
                                                id="highest_qualification_percent">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="highest_qualification_year">High Qualification Year</label>
                                            <input type="number" class="form-control number-without-arrow"
                                                name="highest_qualification_year" id="highest_qualification_year">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($selected && $type == 'PTE')
                    <input type="hidden" name="type" value="pte">
                    <input type="hidden" name="branch" value="{{$branch}}">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                       <a href="{{ url('add-universal-enquiry') }}" class="mr-2 text-red">
                                                <i class="fe fe-corner-up-left"></i></a>
                                        PTE ENQUIRY
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="number" class="form-control number-without-arrow"
                                                name="mobile" id="mobile" required>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="reference">Reference</label>
                                            <input type="text" class="form-control" name="reference" id="reference">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="full_address">Address</label>
                                            <textarea name="full_address" id="full_address" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="highest_qualification_name">High Qualification Name</label>
                                            <input type="text" class="form-control" name="highest_qualification_name"
                                                id="highest_qualification_name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="highest_qualification_percent">High Qualification
                                                Percent</label>
                                            <input type="text" class="form-control"
                                                name="highest_qualification_percent" id="highest_qualification_percent">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="highest_qualification_year">High Qualification Year</label>
                                            <input type="number" class="form-control number-without-arrow"
                                                name="highest_qualification_year" id="highest_qualification_year">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($selected && $type == 'Study Visa')
                    <input type="hidden" name="type" value="Study Visa">
                    <input type="hidden" name="branch" value="{{$branch}}">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="{{ url('add-universal-enquiry') }}" class="mr-2 text-red">
                                                <i class="fe fe-corner-up-left"></i></a>
                                        STUDY VISA ENQUIRY
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="number" class="form-control number-without-arrow"
                                                name="mobile" id="mobile" required>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="reference">Reference</label>
                                            <input type="text" class="form-control" name="reference" id="reference">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="full_address">Address</label>
                                            <textarea name="full_address" id="full_address" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="tenth_name">10th Board or School</label>
                                            <input type="text" class="form-control" name="tenth_name"
                                                id="tenth_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="tenth_start">10th Start Year</label>
                                            <input type="text" class="form-control" name="tenth_start"
                                                id="tenth_start">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="tenth_end">10th Completed Year</label>
                                            <input type="text" class="form-control" name="tenth_end" id="tenth_end">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="tenth_percent">10th Percentage</label>
                                            <input type="text" class="form-control" name="tenth_percent"
                                                id="tenth_percent">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="twlefth_name">12th Board or School</label>
                                            <input type="text" class="form-control" name="twlefth_name"
                                                id="twlefth_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="twlefth_start">12th Start Year</label>
                                            <input type="text" class="form-control" name="twlefth_start"
                                                id="twlefth_start">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="twlefth_end">12th Completed Year</label>
                                            <input type="text" class="form-control" name="twlefth_end"
                                                id="twlefth_end">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="twlefth_percent">12th Percentage</label>
                                            <input type="text" class="form-control" name="twlefth_percent"
                                                id="twlefth_percent">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bachelor_name">Bachelors Stream / Institute</label>
                                            <input type="text" class="form-control" name="bachelor_name"
                                                id="bachelor_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bachelor_start">Bachelors Start Year</label>
                                            <input type="text" class="form-control" name="bachelor_start"
                                                id="bachelor_start">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bachelor_end">Bachelors Completed Year</label>
                                            <input type="text" class="form-control" name="bachelor_end"
                                                id="bachelor_end">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="bachelor_percent">Bachelors Percentage</label>
                                            <input type="text" class="form-control" name="bachelor_percent"
                                                id="bachelor_percent">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="master_name">Masters Stream / Institute</label>
                                            <input type="text" class="form-control" name="master_name"
                                                id="master_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="master_start">Masters Start Year</label>
                                            <input type="text" class="form-control" name="master_start"
                                                id="master_start">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="master_end">Masters Completed Year</label>
                                            <input type="text" class="form-control" name="master_end"
                                                id="master_end">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="master_percent">Masters Percentage</label>
                                            <input type="text" class="form-control" name="master_percent"
                                                id="master_percent">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_name">Any Diploma</label>
                                            <input type="text" class="form-control" name="diploma_name"
                                                id="diploma_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_start">Diploma Start Year</label>
                                            <input type="text" class="form-control" name="diploma_start"
                                                id="diploma_start">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_end">Diploma Completed Year</label>
                                            <input type="text" class="form-control" name="diploma_end"
                                                id="diploma_end">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="diploma_percent">Diloma Percentage</label>
                                            <input type="text" class="form-control" name="diploma_percent"
                                                id="diploma_percent">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Country of Interest</label>
                                            <div class="selectgroup selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="country_of_interest[]" value="Canada"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Canada</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="country_of_interest[]" value="Australia"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Australia</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="country_of_interest[]" value="Singapore"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Singapore</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="country_of_interest[]" value="UK"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">UK</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="country_of_interest[]" value="USA"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">USA</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="country_of_interest[]" value="Europe"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Europe</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="country_of_interest[]"
                                                        value="New Zealand" class="selectgroup-input">
                                                    <span class="selectgroup-button">New Zealand</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Intake</label>
                                            <div class="selectgroup selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="Jan"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Jan</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="Feb"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Feb</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="March"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">March</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="April"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">April</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="May"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">May</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="June"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">June</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="July"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">July</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="Aug"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Aug</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="Sep"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Sep</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="Oct"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Oct</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="Nov"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Nov</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="intake[]" value="Dec"
                                                        class="selectgroup-input">
                                                    <span class="selectgroup-button">Dec</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="course_of_interest">Course of Interest</label>
                                            <input type="text" name="course_of_interest" id="course_of_interest"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="preferred_location">Preferred Location</label>
                                            <input type="text" name="preferred_location" id="preferred_location"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="field_of_interest">Field of Interest</label>
                                            <input type="text" name="field_of_interest" id="field_of_interest"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label class="form-label">Done IELTS / PTE ?</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="custom-switch form-switch me-5">
                                                        <input type="radio" name="done_ielts_or_pte"
                                                            class="custom-switch-input ielts_pte_switch" value="ielts">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">IELTS</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="custom-switch form-switch me-5">
                                                        <input type="radio" name="done_ielts_or_pte"
                                                            class="custom-switch-input ielts_pte_switch" value="pte">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">PTE</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="custom-switch form-switch me-5">
                                                        <input type="radio" name="done_ielts_or_pte"
                                                            class="custom-switch-input ielts_pte_switch" value="nothing" checked>
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Nothing</span>
                                                    </label>
                                                </div>
                                                <div class="form-group col-md-4 scores-input hidden">
                                                    <label for="overall">Overall Score</label>
                                                    <input step="any" type="number" name="overall" id="overall" class="form-control number-without-arrow">
                                                </div>
                                                <div class="form-group col-md-2 scores-input hidden">
                                                    <label for="reading">Reading Score</label>
                                                    <input step="any" type="number" name="reading" id="reading" class="form-control number-without-arrow">
                                                </div>
                                                <div class="form-group col-md-2 scores-input hidden">
                                                    <label for="writing">Writing Score</label>
                                                    <input step="any" type="number" name="writing" id="writing" class="form-control number-without-arrow">
                                                </div>
                                                <div class="form-group col-md-2 scores-input hidden">
                                                    <label for="speaking">Speaking Score</label>
                                                    <input step="any" type="number" name="speaking" id="speaking" class="form-control number-without-arrow">
                                                </div>
                                                <div class="form-group col-md-2 scores-input hidden">
                                                    <label for="listening">Listening Score</label>
                                                    <input step="any" type="number" name="listening" id="listening" class="form-control number-without-arrow">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 @elseif ($selected && $type == 'Tourist Visa')
                <input type="hidden" name="type" value="Tourist Visa">
                <input type="hidden" name="branch" value="{{$branch}}">
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ url('add-universal-enquiry') }}" class="mr-2 text-red">
                                            <i class="fe fe-corner-up-left"></i></a>
                                    TOURIST VISA ENQUIRY
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="mobile">Mobile</label>
                                        <input type="number" class="form-control number-without-arrow"
                                            name="mobile" id="mobile" required>
                                    </div>
                                     <div class="form-group col-md-3">
                                            <label for="reference">Reference</label>
                                            <input type="text" class="form-control" name="reference" id="reference">
                                        </div>
                                    <div class="form-group col-md-12">
                                        <label for="full_address">Address</label>
                                        <textarea name="full_address" id="full_address" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tenth_name">10th Board or School</label>
                                        <input type="text" class="form-control" name="tenth_name"
                                            id="tenth_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tenth_start">10th Start Year</label>
                                        <input type="text" class="form-control" name="tenth_start"
                                            id="tenth_start">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tenth_end">10th Completed Year</label>
                                        <input type="text" class="form-control" name="tenth_end" id="tenth_end">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tenth_percent">10th Percentage</label>
                                        <input type="text" class="form-control" name="tenth_percent"
                                            id="tenth_percent">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="twlefth_name">12th Board or School</label>
                                        <input type="text" class="form-control" name="twlefth_name"
                                            id="twlefth_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="twlefth_start">12th Start Year</label>
                                        <input type="text" class="form-control" name="twlefth_start"
                                            id="twlefth_start">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="twlefth_end">12th Completed Year</label>
                                        <input type="text" class="form-control" name="twlefth_end"
                                            id="twlefth_end">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="twlefth_percent">12th Percentage</label>
                                        <input type="text" class="form-control" name="twlefth_percent"
                                            id="twlefth_percent">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bachelor_name">Bachelors Stream / Institute</label>
                                        <input type="text" class="form-control" name="bachelor_name"
                                            id="bachelor_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bachelor_start">Bachelors Start Year</label>
                                        <input type="text" class="form-control" name="bachelor_start"
                                            id="bachelor_start">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bachelor_end">Bachelors Completed Year</label>
                                        <input type="text" class="form-control" name="bachelor_end"
                                            id="bachelor_end">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bachelor_percent">Bachelors Percentage</label>
                                        <input type="text" class="form-control" name="bachelor_percent"
                                            id="bachelor_percent">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="master_name">Masters Stream / Institute</label>
                                        <input type="text" class="form-control" name="master_name"
                                            id="master_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="master_start">Masters Start Year</label>
                                        <input type="text" class="form-control" name="master_start"
                                            id="master_start">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="master_end">Masters Completed Year</label>
                                        <input type="text" class="form-control" name="master_end"
                                            id="master_end">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="master_percent">Masters Percentage</label>
                                        <input type="text" class="form-control" name="master_percent"
                                            id="master_percent">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="diploma_name">Any Diploma</label>
                                        <input type="text" class="form-control" name="diploma_name"
                                            id="diploma_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="diploma_start">Diploma Start Year</label>
                                        <input type="text" class="form-control" name="diploma_start"
                                            id="diploma_start">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="diploma_end">Diploma Completed Year</label>
                                        <input type="text" class="form-control" name="diploma_end"
                                            id="diploma_end">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="diploma_percent">Diloma Percentage</label>
                                        <input type="text" class="form-control" name="diploma_percent"
                                            id="diploma_percent">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Country of Interest</label>
                                        <div class="selectgroup selectgroup-pills">
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="country_of_interest[]" value="Canada"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Canada</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="country_of_interest[]" value="Australia"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Australia</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="country_of_interest[]" value="Singapore"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Singapore</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="country_of_interest[]" value="UK"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">UK</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="country_of_interest[]" value="USA"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">USA</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="country_of_interest[]" value="Europe"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Europe</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="country_of_interest[]"
                                                    value="New Zealand" class="selectgroup-input">
                                                <span class="selectgroup-button">New Zealand</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Intake</label>
                                        <div class="selectgroup selectgroup-pills">
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="Jan"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Jan</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="Feb"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Feb</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="March"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">March</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="April"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">April</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="May"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">May</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="June"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">June</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="July"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">July</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="Aug"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Aug</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="Sep"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Sep</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="Oct"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Oct</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="Nov"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Nov</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="intake[]" value="Dec"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Dec</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="course_of_interest">Course of Interest</label>
                                        <input type="text" name="course_of_interest" id="course_of_interest"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="preferred_location">Preferred Location</label>
                                        <input type="text" name="preferred_location" id="preferred_location"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="field_of_interest">Field of Interest</label>
                                        <input type="text" name="field_of_interest" id="field_of_interest"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-12 mb-2">
                                        <label class="form-label">Done IELTS / PTE ?</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="custom-switch form-switch me-5">
                                                    <input type="radio" name="done_ielts_or_pte"
                                                        class="custom-switch-input ielts_pte_switch" value="ielts">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">IELTS</span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="custom-switch form-switch me-5">
                                                    <input type="radio" name="done_ielts_or_pte"
                                                        class="custom-switch-input ielts_pte_switch" value="pte">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">PTE</span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="custom-switch form-switch me-5">
                                                    <input type="radio" name="done_ielts_or_pte"
                                                        class="custom-switch-input ielts_pte_switch" value="nothing" checked>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">Nothing</span>
                                                </label>
                                            </div>
                                            <div class="form-group col-md-4 scores-input hidden">
                                                <label for="overall">Overall Score</label>
                                                <input step="any" type="number" name="overall" id="overall" class="form-control number-without-arrow">
                                            </div>
                                            <div class="form-group col-md-2 scores-input hidden">
                                                <label for="reading">Reading Score</label>
                                                <input step="any" type="number" name="reading" id="reading" class="form-control number-without-arrow">
                                            </div>
                                            <div class="form-group col-md-2 scores-input hidden">
                                                <label for="writing">Writing Score</label>
                                                <input step="any" type="number" name="writing" id="writing" class="form-control number-without-arrow">
                                            </div>
                                            <div class="form-group col-md-2 scores-input hidden">
                                                <label for="speaking">Speaking Score</label>
                                                <input step="any" type="number" name="speaking" id="speaking" class="form-control number-without-arrow">
                                            </div>
                                            <div class="form-group col-md-2 scores-input hidden">
                                                <label for="listening">Listening Score</label>
                                                <input step="any" type="number" name="listening" id="listening" class="form-control number-without-arrow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if ($selected)
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <button type="submit" class="btn btn-success btn-lg"><i
                                    class="fe fe-check me-2"></i>Save</button>
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
            swal('Congratulations!', 'Enquiry added successfully', 'success');
        </script>
    @endif
@endsection
