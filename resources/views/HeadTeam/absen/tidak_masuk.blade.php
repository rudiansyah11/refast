<!-- TITLE  -->
@section('title', 'Absen Tidak Masuk')

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
                    <h6 class="panel-title">Absent Tidak Masuk</h6>
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
                        - Pilih terlebih dahulu jenis tidak masuknya.<br>
                        - Mohon untuk mencantumkan file document bukti keterangan tidak masuknya.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" id="photoForm_absen_masuk" enctype="multipart/form-data" action="{{ route('HeadTeam.prosesabsentidakmasuk') }}">
                                        @csrf
                                        <input type="hidden" name="absen_type" value="Absent Alpha">
                                        <input type="hidden" id="latitude_absen" name="latitude_absen" class="form-control input-xs">
                                        <input type="hidden" id="longitude_absen" name="longitude_absen" class="form-control input-xs">
                                        <div class="row">
                                            <div class="col-md-2 form-group @error('jenis_keterangan') has-warning has-feedback @enderror">
                                                <label>Jenis Tidak Masuk:</label>
                                                <select name="jenis_keterangan" id="jenis_keterangan" class="form-control input-xs" required>
                                                    <option value="">---</option>
                                                    <option value="Cuti">Cuti</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Sakit">Sakit</option>
                                                </select>
                                                @error('jenis_keterangan')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-1 jumlah_hari form-group">
                                                <label>Jumlah Hari:</label>
                                                <input type="number" name="jumlah_hari" class="form-control input-xs" max="3">
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label>Keterangan:</label>
                                                <textarea name="keterangan" id="keterangan" rows="2" class="form-control input-xs" required placeholder="Masukan keterangan"></textarea>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label for="filenya">Cantumkan dokument bukti keterangan tidak masuk</label>
                                                <input type="file" class="file-input-pdf" name="filenya">
                                                <span class="help-block">Allow only specific file extensions. In this example only <code>pdf, jpg, jpeg, png</code> extensions are allowed. and lower case word</span>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                    <a href="{{route('HeadTeam.menu')}}" class="btn btn-danger" >Kembali <i class="icon-backspace2 position-right"></i></a>
                                        <button type="submit" class="btn btn-primary mx-auto text-white d-none" id="uploadphoto_office" form="photoForm_absen_masuk">Submit</button>
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

<!-- FILE ATTACHMENT -->
<script>
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Modal template Form UPLOAD PDF
    var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header">\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
            fullscreen: 'btn btn-default btn-icon btn-xs',
            borderless: 'btn btn-default btn-icon btn-xs',
            close: 'btn btn-default btn-icon btn-xs'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross3"></i>'
        };

        // FILE UPLOAD LOADER
        $(".file-input-pdf").fileinput({
            browseLabel: 'Browse',
            browseClass: 'btn btn-primary',
            uploadClass: 'btn btn-default',
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            maxFilesNum: 10,
            allowedFileExtensions: ["pdf", "jpg", "jpeg", "png"],
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons
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


        $('.jumlah_hari').hide();
        $('#jenis_keterangan').on('change', function () {
            if(this.value == "Cuti"){
                swal({
                    title: 'Warning',
                    text: 'Masukan berapa hari cutinya.',
                    icon: 'warning'
                });
                $('.jumlah_hari').show();
            } else {
                $('.jumlah_hari').hide();
            }
        });

    });
</script>
@endsection