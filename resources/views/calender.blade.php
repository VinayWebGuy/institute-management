
@extends('layouts.main')
@section('title', 'Calendar')
@section('home', 'active')
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Calendar</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW OPEN-->
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="cal1"></div>
                    </div>
                </div>
            </div>
            <!-- ROW CLOSE-->
        </div>
        <!-- CONTAINER CLOSE-->
    </div>
</div>
@endsection