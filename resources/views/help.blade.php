@extends('layouts.main')
@section('title', 'Help')
@section('help', 'active')
@section('content')
<style>
    .accordion-body a{
       color:red;
       text-decoration:underline;
       font-weight:800;
    }
</style>
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Help</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Help</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3 class="card-title col-md-8">We're here to help you.</h3>
                                <form action="" method="get" class="col-md-4">
                                    <input type="text" class="form-control" name="help" placeholder="Search Help"
                                        value="{{ $key }}">
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="helpBlocks">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($help as $h)
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="flush-heading{{$i}}">
                                        <button class="accordion-button collapsed help-title" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$i}}" aria-expanded="false" aria-controls="flush-collapse{{$i}}">
                                          {{$h->title}}
                                        </button>
                                      </h2>
                                      <div id="flush-collapse{{$i}}" class="accordion-collapse collapse help-desc" aria-labelledby="flush-heading{{$i}}" data-bs-parent="#helpBlocks">
                                        <div class="accordion-body">
                                            {!! $h->description !!}
                                        </div>
                                      </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
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
            swal('Congratulations!', 'Staff data deleted successfully', 'success');
        </script>
    @endif
@endsection
