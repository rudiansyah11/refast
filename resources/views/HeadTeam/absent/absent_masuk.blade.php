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

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Absent Masuk</h6>
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
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row col-md-12 form-group">
                                <label>Lokasi Absent:</label>
                                <select name="location_absent" id="location_absent" class="form-control input-xs @error('location_absent') is-invalid @enderror">
                                    <option value="">---</option>
                                    <option value="Office">Office</option>
                                    <option value="Project">Project</option>
                                    <option value="Lainnya">Lainnya</option>
                                    @error('location_absent')
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                        </div>

                        <div class="col-md-9">

                            <!-- Ketika Pilih Absent Masuk di Office -->
                            <div class="row office">
                                <div class="col-md-12">
                                    <form method="post" id="photoForm_office" enctype="multipart/form-data">
                                        <input type="hidden" name="absent_masuk" value="office">    
                                        <input type="hidden" id="photoStore_office" name="photoStore_office" value="">
                                        <div class="row">
                                            <div class="col-md-6 form-group @error('latitude_office') has-warning has-feedback @enderror">
                                                <label>Latitude:</label>
                                                <input type="text" id="latitude_office" name="latitude_office" value="{{ old('latitude_office') }}" class="form-control input-xs" disabled>
                                                @error('latitude')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group @error('longitude_office') has-warning has-feedback @enderror">
                                                <label>Longitude:</label>
                                                <input type="text" id="longitude_office" name="longitude_office" value="{{ old('longitude_office') }}" class="form-control input-xs" disabled>
                                                @error('longitude_office')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <div id="my_camera_office" class="d-block mx-auto rounded overflow-hidden border border-secondary mb-3 img-thumbnail"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div id="results_office" class="d-none mx-auto overflow-hidden img-thumbnail"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto_office">Capture</button>
                                        <button type="submit" class="btn btn-primary mx-auto text-white d-none" id="uploadphoto_office" form="photoForm_office">Submit</button>
                                        <div class="loader">
                                            <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ketika Pilih Absent Masuk di Project -->
                            <div class="row project">
                                <div class="col-md-12">
                                    <form method="post" id="photoForm_project" enctype="multipart/form-data">
                                        <input type="hidden" name="absent_masuk" value="project">    
                                        <input type="hidden" id="photoStore_project" name="photoStore_project" value="">
                                        <div class="row">
                                            <div class="col-md-3 form-group @error('latitude_project') has-warning has-feedback @enderror">
                                                <label>Latitude:</label>
                                                <input type="text" id="latitude_project" name="latitude_project" value="{{ old('latitude_project') }}" class="form-control input-xs" disabled>
                                                @error('latitude_project')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group @error('longitude_project') has-warning has-feedback @enderror">
                                                <label>Longitude:</label>
                                                <input type="text" id="longitude_project" name="longitude_project" value="{{ old('longitude_project') }}" class="form-control input-xs" disabled>
                                                @error('longitude_project')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group @error('no_project') has-warning has-feedback @enderror">
                                                <label>No Project:<span class="text-danger">*</label>
                                                <input type="text" id="no_project" name="no_project" placeholder="Mohon untuk mengisi No Project yg dikerjakan" class="form-control input-xs" required>
                                                @error('no_project')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <div id="my_camera_project" class="d-block mx-auto rounded overflow-hidden border border-secondary mb-3 img-thumbnail"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div id="results_project" class="d-none mx-auto overflow-hidden img-thumbnail"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto_project">Capture</button>
                                            <button type="submit" class="btn btn-primary mx-auto text-white d-none" id="uploadphoto_project" form="photoForm_project">Submit</button>
                                            <div class="loader">
                                                <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Ketika Pilih Absent Masuk di Lainnya -->
                            <div class="row lainnya">
                                <div class="col-md-12">
                                    <form method="post" id="photoForm" enctype="multipart/form-data">
                                        <input type="hidden" name="absent_masuk" value="lainnya">    
                                        <input type="hidden" id="photoStore" name="photoStore" value="">
                                        <div class="row">
                                            <div class="col-md-3 form-group @error('latitude') has-warning has-feedback @enderror">
                                                <label>Latitude:</label>
                                                <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" class="form-control input-xs" disabled>
                                                @error('latitude')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group @error('longitude') has-warning has-feedback @enderror">
                                                <label>Longitude:</label>
                                                <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" class="form-control input-xs" disabled>
                                                @error('longitude')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group @error('keterangan') has-warning has-feedback @enderror">
                                                <label>Keterangan:<span class="text-danger">*</label>
                                                <input type="text" id="keterangan" name="keterangan" placeholder="Mohon untuk mengisi No Project yg dikerjakan" class="form-control input-xs" required>
                                                @error('keterangan')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <div id="my_camera" class="d-block mx-auto rounded overflow-hidden border border-secondary mb-3 img-thumbnail"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <div id="results" class="d-none mx-auto overflow-hidden img-thumbnail"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto">Capture</button>
                                            <button type="submit" class="btn btn-primary mx-auto text-white d-none" id="uploadphoto" form="photoForm">Submit</button>
                                            <div class="loader">
                                                <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

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

<!-- pilih form -->
<script>
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $(".office").hide();
	$(".project").hide();
    $(".lainnya").hide();

	$('#location_absent').on('change', function () {
  		if(this.value == "Office"){
			$(".office").show();
			$(".project").hide();
            $(".lainnya").hide();

            // get your location ==---
            getLocation();
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    console.log("Geolocation is not supported by this browser.");
                }
            }

            function showPosition(position) {
                $('#latitude_office').val(position.coords.latitude);
                $('#longitude_office').val(position.coords.longitude);
            }

            // Open Web Camp ==---
            Webcam.set({
                width: 350,
                height: 300,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.reset();
            Webcam.on('error', function() {
                swal({
                    title: 'Warning',
                    text: 'Please give permission to access your webcam',
                    icon: 'warning'
                });
            });
            Webcam.attach('#my_camera_office');
            $('#takephoto_office').on('click', take_snapshot_office);


  		} else if(this.value == "Project"){
  			$(".office").hide();
			$(".project").show();
            $(".lainnya").hide();

            // get your location ==---
            getLocation();
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    console.log("Geolocation is not supported by this browser.");
                }
            }

            function showPosition(position) {
                $('#latitude_project').val(position.coords.latitude);
                $('#longitude_project').val(position.coords.longitude);
            }

            // Open Web Camp ==---
            Webcam.set({
                width: 350,
                height: 300,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.reset();
            Webcam.on('error', function() {
                swal({
                    title: 'Warning',
                    text: 'Please give permission to access your webcam',
                    icon: 'warning'
                });
            });
            Webcam.attach('#my_camera_project');
            $('#takephoto_project').on('click', take_snapshot_project);

  		} else {
            $(".office").hide();
			$(".project").hide();
            $(".lainnya").show();

            // get your location ==---
            getLocation();
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
            }

            // Open Web Camp ==---
            Webcam.set({
                width: 350,
                height: 300,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.reset();
            Webcam.on('error', function() {
                swal({
                    title: 'Warning',
                    text: 'Please give permission to access your webcam',
                    icon: 'warning'
                });
            });
            Webcam.attach('#my_camera');
            $('#takephoto').on('click', take_snapshot);
  		}

        // OTHER FUNCTION ===-------------

        // fungsi foto office
        function take_snapshot_office(){
            //take snapshot and get image data
            Webcam.snap(function(data_uri) {
                //display result image
                $('#results_office').html('<img style="width: 365px; height: 280px;" src="' + data_uri + '" class="" />');
                
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                $('#photoStore_office').val(raw_image_data);
            });

            $('#my_camera_office').removeClass('d-block');
            $('#my_camera_office').addClass('d-none');

            $('#results_office').removeClass('d-none');

            $('#takephoto_office').html('Re-Capture');
        }

        // submit form absen masuk office ==---
        $('#photoForm_office').on('submit', function(e) {
            console.log('Tombol bisa di click....');
            $("#uploadphoto_office").prop('disabled', true);
            $('.loader').show();
            e.preventDefault();
            $.ajax({
                url: '{{ route("HeadTeam.processAbsentMasuk") }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if(data == 'success') {
                        Webcam.reset();
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
                    
                    } else {
                        swal({
                            title: 'Error',
                            text: 'Mohon untuk ambil gambar terlebih dahulu',
                            icon: 'error'
                        });
                        $("#uploadphoto_office").prop('disabled', false);
                        $('.loader').hide();    
                    }
                }
            })
        });


        // fungsi foto project ==---
        function take_snapshot_project(){
            //take snapshot and get image data
            Webcam.snap(function(data_uri) {
                //display result image
                $('#results_project').html('<img style="width: 365px; height: 280px;" src="' + data_uri + '" class="" />');

                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                $('#photoStore_project').val(raw_image_data);
            });

            $('#my_camera__project').removeClass('d-block');
            $('#my_camera__project').addClass('d-none');

            $('#results_project').removeClass('d-none');

            $('#takephoto_project').html('Re-Capture');
        }

        // submit form absen masuk project ==---
        $('#photoForm_project').on('submit', function(e) {
            console.log('Tombol bisa di click....');
            $("#uploadphoto_project").prop('disabled', true);
            $('.loader').show();
            e.preventDefault();
            $.ajax({
                url: '{{ route("HeadTeam.processAbsentMasuk") }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if(data == 'success') {
                        Webcam.reset();
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
                    
                    } else {
                        swal({
                            title: 'Error',
                            text: 'Mohon untuk ambil gambar terlebih dahulu',
                            icon: 'error'
                        });
                        $("#uploadphoto_project").prop('disabled', false);
                        $('.loader').hide();    
                    }
                }
            })
        });


        // fungsi foto lainnya ==---
        function take_snapshot(){
            //take snapshot and get image data
            Webcam.snap(function(data_uri) {
                //display result image
                $('#results').html('<img style="width: 365px; height: 280px;" src="' + data_uri + '" class="" />');

                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                $('#photoStore').val(raw_image_data);
            });

            $('#my_camera').removeClass('d-block');
            $('#my_camera').addClass('d-none');

            $('#results').removeClass('d-none');

            $('#takephoto').html('Re-Capture');
        }

        // submit form absen masuk lainnya ==---
        $('#photoForm').on('submit', function(e) {
            console.log('Tombol bisa di click....');
            $("#uploadphoto").prop('disabled', true);
            $('.loader').show();
            e.preventDefault();
            $.ajax({
                url: '{{ route("HeadTeam.processAbsentMasuk") }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if(data == 'success') {
                        Webcam.reset();
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
                    
                    } else {
                        swal({
                            title: 'Error',
                            text: 'Mohon untuk ambil gambar terlebih dahulu',
                            icon: 'error'
                        });
                        $("#uploadphoto").prop('disabled', false);
                        $('.loader').hide();    
                    }
                }
            })
        });

	});

}); 

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

    });
</script>
@endsection