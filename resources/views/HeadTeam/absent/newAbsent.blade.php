<!-- TITLE  -->
@section('title', 'Absent Page')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<style type="text/css">
    .loader{
        display: none;
    }

    .loader-out{
        display: none;
    }
</style>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Absent</span> - Entry & Out</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <!-- <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-stats-bars text-primary"></i><span>Dashboard</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-box-add text-primary"></i> <span>Create New Data</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-file-excel text-primary"></i> <span>Export to Excel</span>
                </a> -->
            </div>
        </div>
    </div>
</div>
<!-- /page header -->

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Absent Entry & Out</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        <h6 class="alert-heading text-semibold">Notification:</h6>
                        - Jika ada notif pop up berupa izin mengaktifkan camera dan lokasi, Mohon untuk memilih tombol Allow<br>
                        - Absent masuk bisa dilakukan jika lokasi anda berada max 100 Meter dari kantor<br>
                        - Tombol <b>Absen Keluar</b> tidak akan bisa diklik jika belum melakukan absent masuk.
                    </div>
                    <?php
                        // check for button submit, untuk disabled buttonnya ada di JS bawah..
                        // $check_datanya = $check_absen->count() ;
                        if( !empty($check_absen) ){
                            if( is_null($check_absen->end_date) ){
                                // kalo udh absen masuk tapi blm absen keluar
                                $btn_masuk = "disabled";
                                $btn_keluar = "";

                            } else {
                                // kalo udh absen masuk & keluar
                                $btn_masuk = "disabled";
                                $btn_keluar = "disabled";
                            }
                        
                        } else {
                            // kalo blm absen sama sekali
                            $btn_masuk = "";
                            $btn_keluar = "disabled";
                        }

                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-danger" id="accesscamera" data-toggle="modal" data-target="#absent-entry"><i class="icon-enter2 position-right"></i> Absent Entry</button>
                            
                            <!-- Full Modal Absent Entry -->
                            <div id="absent-entry" class="modal fade">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h5 class="modal-title">Ambil Posisi Gambar</h5>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <div id="my_camera" class="d-block mx-auto rounded overflow-hidden border border-secondary mb-3"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div id="results" class="d-none mt-3"></div>
                                                </div>
                                            </div>
                                            <form method="post" id="photoForm" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="photoStore" name="photoStore" value="">
                                                <input type="text" id="latitude" name="latitude">
                                                <input type="text" id="longitude" name="longitude">
                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal" id="close_modal">Close</button>
                                            <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto">Capture</button>
                                            <button type="submit" class="btn btn-primary mx-auto text-white d-none" id="uploadphoto" form="photoForm">Submit</button>
                                            <div class="loader">
                                                <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Full Modal Absent Entry -->
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-primary" id="accesscamera-out" data-toggle="modal" data-target="#absent-out"><i class="icon-exit3 position-right"></i> Absent Out</button>
                            
                            <!-- Full Modal Absent Out -->
                            <div id="absent-out" class="modal fade">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h5 class="modal-title">Ambil Posisi Gambar</h5>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <div id="my_camera_out" class="d-block mx-auto rounded overflow-hidden border border-secondary mb-3"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div id="results_out" class="d-none mt-3"></div>
                                                </div>
                                            </div>
                                            <form method="post" id="photoForm_out" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="photoStore_out" name="photoStore_out" value="">
                                                <input type="text" id="latitude_out" name="latitude_out">
                                                <input type="text" id="longitude_out" name="longitude_out">
                                                <input type="text" id="passing_id" name="passing_id" value="{{ $check_absen->passing_id }}">
                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal" id="close_modal">Close</button>
                                            <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto_out">Capture</button>
                                            <button type="submit" class="btn btn-primary mx-auto text-white d-none" id="uploadphoto_out" form="photoForm_out">Submit</button>
                                            <div class="loader-out">
                                                <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Full Modal Absent Out -->
                        </div>
                    </div>
                    <hr>
                    <div class="schedule"></div>
                </div>
            </div>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>

<!-- Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session('success'))
<script>
    swal("Great Jobs :)", "{!! Session::get('success') !!}", "success");
</script>
@elseif(Session('error'))
<script>
    swal("Upps, Sorry", "{!! Session::get('error') !!}", "warning");
</script>
@endif

<?php 
    if($btn_masuk == "disabled"){
        echo '<script>$("#accesscamera").prop("disabled", true);</script>';
    }

    if($btn_keluar == "disabled"){
        echo '<script>$("#accesscamera-out").prop("disabled", true);</script>';
    }
?>

<!-- Show and Setup Camera -->
<script>
    $(document).ready(function() {
        // $("#uploadphoto").prop('disabled', true);

        Webcam.set({
            width: 500,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        // accesscamera untuk absen masuk 
        $('#accesscamera').on('click', function() {
            Webcam.reset();
            Webcam.on('error', function() {
                $('#photoModal').modal('hide');
                swal({
                    title: 'Warning',
                    text: 'Please give permission to access your webcam',
                    icon: 'warning'
                });
            });
            Webcam.attach('#my_camera');
        });

        // accesscamera untuk absen keluar
        $('#accesscamera-out').on('click', function() {
            Webcam.reset();
            Webcam.on('error', function() {
                $('#photoModal').modal('hide');
                swal({
                    title: 'Warning',
                    text: 'Please give permission to access your webcam',
                    icon: 'warning'
                });
            });
            Webcam.attach('#my_camera_out');
        });

        $('#takephoto').on('click', take_snapshot);
        $('#takephoto_out').on('click', take_snapshot_out);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        //submit form absen masuk 
        $('#photoForm').on('submit', function(e) {
            $("#uploadphoto").prop('disabled', true);
            $('.loader').show();
            e.preventDefault();
            $.ajax({
                url: '{{ route("HeadTeam.processAbsentEntry") }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data == 'success') {
                        Webcam.reset();
                        $('#photoModal').modal('hide');

                        swal({
                            title: 'Success',
                            text: 'Berhasil Melakukan Absen Masuk',
                            icon: 'success',
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            timer: 1000
                        })

                        window.location.replace('/HeadTeam/Absent');
                    }
                    else {
                        swal({
                            title: 'Error',
                            text: 'Mohon untuk ambil gambar terlebih dahulu',
                            icon: 'error'
                        })
                    }
                }
            })
        });

        //submit form absen pulang 
        $('#photoForm_out').on('submit', function(e) {
            $("#uploadphoto_out").prop('disabled', false);
            $('.loader-out').show();
            e.preventDefault();
            $.ajax({
                url: '{{ route("HeadTeam.processAbsentOut") }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data == 'success') {
                        Webcam.reset();
                        $('#photoModal').modal('hide');

                        swal({
                            title: 'Success',
                            text: 'Absen Pulang berhasil.',
                            icon: 'success',
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            timer: 1000
                        });

                        window.location.replace('/HeadTeam/Absent');
                
                    } else if(data == 'min_8jam'){
                        swal({
                            title: 'Error',
                            text: 'Gagal Absen Pulang, karena belum jam kerja belum 8',
                            icon: 'warning'
                        });

                    } else {
                        swal({
                            title: 'Error',
                            text: 'Mohon untuk ambil gambar terlebih dahulu',
                            icon: 'error'
                        });
                    }

                    $("#uploadphoto_out").removeProp('disabled', true);
                    $('.loader-out').hide();
                }
            })
        });
    });

    function take_snapshot(){
        //take snapshot and get image data
        Webcam.snap(function(data_uri) {
            //display result image
            $('#results').html('<img src="' + data_uri + '" class="d-block mx-auto rounded"/>');

            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            $('#photoStore').val(raw_image_data);
        });

        $('#my_camera').removeClass('d-block');
        $('#my_camera').addClass('d-none');

        $('#results').removeClass('d-none');

        $('#takephoto').removeClass('d-block');
        $('#takephoto').addClass('d-none');

    }

    function take_snapshot_out(){
        //take snapshot and get image data
        Webcam.snap(function(data_uri) {
            //display result image
            $('#results_out').html('<img src="' + data_uri + '" class="d-block mx-auto rounded"/>');

            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            $('#photoStore_out').val(raw_image_data);
        });
    }
</script>

<!-- get your location -->
<script>
    getLocation();
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);

        $('#latitude_out').val(position.coords.latitude);
        $('#longitude_out').val(position.coords.longitude);
        
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){

        // untuk yang form abseb entry
        $("#form-submit").submit(function(){
            $("#btn-submit").prop('disabled', true);
            $('.loader').show();
        });

        // untuk yang form abseb out
        $("#form-submit-out").submit(function(){
            $("#btn-submit-out").prop('disabled', true);
            $('.loader-out').show();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }

        });
        
        // var schedule = $('.schedule').fullCalendar();
        var schedule = $('.schedule').fullCalendar({
            editable:false,
            header:{
                left:'prev,next',
                center:'title',
                right:'month,agendaWeek'
            },
            events: '/HeadTeam/get_dataAbsent',
            selectable:true,
            selectHelper:true
        });

    });
</script>
@endsection