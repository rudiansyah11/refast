<!-- TITLE  -->
@section('title', 'Tester Upload Image')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<style type="text/css">
    .loader{
        display: none;
    }
</style>

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main Content -->
        <div class="content-wrapper">

            <!-- Tab content -->
            <div class="tab-content">

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Tester Upload Image<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <p>Click the button to get your coordinates.</p>

                        <button onclick="getLocation()">Try It</button>

                        <p id="demo"></p>
                        <input type="text" id="latitude" name="latitude">
                        <input type="text" id="longitude" name="longitude">
                    </div>
                    <!-- <div class="panel-body">
                        <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <h6 class="alert-heading text-semibold">Tester Upload Image</h6>
                            Untuk Test Upload aja
                        </div> 

                        <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.process_register') }}" method="POST">
                            <fieldset class="content-group">
                                <legend class="text-bold">Register</legend>
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="username">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group @error('title') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-2">title</label>
                                            <div class="col-lg-9">
                                                <input type="title" name="title" class="form-control input-xs" value="{{ old('title') }}">
                                                @error('title')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group @error('name') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-2">File: (JPG)</label>
                                            <div class="col-lg-9">
                                                <input type="file" name="name" class="form-control input-xs" value="{{ old('name') }}">
                                                @error('name')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="text-right">
                                <div class="loader">
                                    <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                </div>
                                <button type="submit" class="btn btn-primary" id="btn-submit">Submit <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </form>
                    </div> -->
                </div>

            </div>
        </div>
        <!-- /main Content -->

    </div>
    <!-- /page content -->

</div>

<script type="text/javascript">
    $(document).ready(function(){

        $("#form-submit").submit(function(){
            $("#btn-submit").prop('disabled', true);
            $('.loader').show();
        });

    });
</script>

<!-- Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session('success'))
<script>
    swal("Great Jobs :)", "{!! Session::get('success') !!}", "success");
</script>
@endif

<script>
    getLocation();
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;

        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);

    }
</script>
@endsection