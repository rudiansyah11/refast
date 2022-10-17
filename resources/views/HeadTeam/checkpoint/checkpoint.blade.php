<!-- TITLE  -->
@section('title', 'Check Point Position')

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
                    <h6 class="panel-title">Check Point</h6>
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
                        - Lorem Dipsum<br>
                        - Lorem Dipsum<br>
                        - Lorem Dipsum.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" id="photoForm_checkpoint" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" id="photoStore" name="photoStore" value="">
                                        <div class="row">
                                        <div class="col-md-3 form-group @error('deskripsi') has-warning has-feedback @enderror">
                                                <label>Deskripsi:</label>
                                                <select id="deskripsi" name="deskripsi" class="form-control input-xs" required>
                                                    <option value="">-----</option>
                                                    @foreach($datanya['category'] as $row)
                                                        <option value="{{$row->category}}">{{$row->category}}</option>
                                                    @endforeach
                                                </select>
                                                @error('deskripsi')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group @error('project_number') has-warning has-feedback @enderror">
                                                <label>Untuk Project Number:</label>
                                                <input type="text" id="project_number" name="project_number" value="" class="form-control input-xs" placeholder="Enter Project Number" required>
                                                @error('project_number')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group @error('latitude_absen') has-warning has-feedback @enderror">
                                                <label>Latitude:</label>
                                                <input type="text" id="latitude_absen" name="latitude_absen" value="{{ old('latitude_absen') }}" class="form-control input-xs" readonly>
                                                @error('latitude')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 form-group @error('longitude_absen') has-warning has-feedback @enderror">
                                                <label>Longitude:</label>
                                                <input type="text" id="longitude_absen" name="longitude_absen" value="{{ old('longitude_absen') }}" class="form-control input-xs" readonly>
                                                @error('longitude_absen')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-3 d-flex justify-content-center">
                                                <div class="text-center">
                                                    <div id="my_camera_absen" class="d-block mx-auto rounded overflow-hidden border border-secondary mb-3 img-thumbnail"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-3 d-flex justify-content-center">
                                                <div class="text-center">
                                                    <div id="results" class="d-none mx-auto overflow-hidden img-thumbnail"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto_absenmasuk">Capture</button>
                                        <button type="submit" class="btn btn-primary mx-auto text-white d-none" id="uploadphoto_office" form="photoForm_checkpoint">Submit</button>
                                        <div class="loader">
                                            <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                        </div>
                                    </div>
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

<!-- GET LOCATION -->
<script>
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
        $('#latitude_absen').val(position.coords.latitude);
        $('#longitude_absen').val(position.coords.longitude);
    }
</script>

<!-- WEB CAMERA -->
<script>
$(document).ready(function() {

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
    Webcam.attach('#my_camera_absen');
    $('#takephoto_absenmasuk').on('click', take_snapshot);

    // fungsi cekrek atau foto
    function take_snapshot(){
        //take snapshot and get image data
        Webcam.snap(function(data_uri) {
            //display result image
            $('#results').html('<img style="width: 365px; height: 280px;" src="' + data_uri + '" class="" />');
            
            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            $('#photoStore').val(raw_image_data);
        });

        $('#my_camera_absen').removeClass('d-block');
        $('#my_camera_absen').addClass('d-none');

        $('#results').removeClass('d-none');

        $('#takephoto_absenmasuk').html('Re-Capture');
    }

    // submit form absen masuk ==---
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $('#photoForm_checkpoint').on('submit', function(e) {
        console.log('Tombol bisa di click....');
        $("#uploadphoto_office").prop('disabled', true);
        $('.loader').show();
        e.preventDefault();
        $.ajax({
            url: '{{ route("HeadTeam.prosescheckpoint") }}',
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
                        timer: 2000,
                        confirmButtonText: 'Okey'
                        
                    }).then((result) => {
                        window.location.replace('/HeadTeam/menu');
                    })

                
                } else if(data == 'fail') {
                    swal({
                        title: 'Error',
                        text: 'Upss Sorry, ada yg bermasalah',
                        icon: 'error'
                    });
                    $("#uploadphoto_office").prop('disabled', false);
                    $('.loader').hide();

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