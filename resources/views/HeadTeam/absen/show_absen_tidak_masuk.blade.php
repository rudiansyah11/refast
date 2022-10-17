<!-- TITLE  -->
@section('title', 'Absen tidak masuk')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<style type="text/css">
    .loader{
        display: none;
    }
</style>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Absen tidak masuk</span> - {{ $datanya->description; }}</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
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
                    <h5 class="panel-title">{{ $datanya->category_activity }}</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.uploaddocument_tidak_masuk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                    <input type="hidden" value="{{ $datanya->passing_id; }}" name="passing_id">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <label>Activity:</label>
                                <input type="text" class="form-control input-xs" value="{{$datanya->category_activity}}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Tanggal:</label>
                                <input type="text" class="form-control input-xs" value="{{ $datanya->start_date }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="col-md-5">
                                <label>Jenis Tidak Masuk:</label>
                                <select name="jenis_keterangan" id="jenis_keterangan" class="form-control input-xs" required>
                                    @if($datanya->description == "Cuti")
                                        <option value="Cuti" selected>cuti</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                    @elseif($datanya->description == "Izin")
                                        <option value="Cuti">cuti</option>
                                        <option value="Izin" selected>Izin</option>
                                        <option value="Sakit">Sakit</option>
                                    @elseif($datanya->description == "Sakit")
                                        <option value="Cuti">cuti</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit" selected>Sakit</option>
                                    @else
                                        <option value="" selected>---</option>
                                        <option value="Cuti">cuti</option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-7">
                                <label>Keterangan:</label>
                                <textarea name="keterangan" id="keterangan" rows="2" class="form-control input-xs" required>{{ $datanya->keterangan_other}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            @if($datanya->photonya == "-")
                                <div class="col-md-12 form-group">
                                    <label for="filenya">Cantumkan dokument bukti keterangan tidak masuk</label>
                                    <input type="file" class="file-input-pdf" name="filenya">
                                    <span class="help-block">Allow only specific file extensions. In this example only <code>pdf, jpg, jpeg, png</code> extensions are allowed. and lower case word</span>
                                </div>
                                <!--  
                                <div class="col-md-12 form-group">
                                    <label>Dokument bukti tidak masuk:</label>
                                    <a href="#" class="btn btn-sm btn-warning form-control"> Download Document</a>
                                </div>
                                -->
                            @else
                                <div class="col-md-12 form-group">
                                    <label>Dokument bukti tidak masuk:</label>
                                    <a href="{{ asset('storage/uploads/document_absen/'.$datanya->photonya ) }}" class="btn btn-sm btn-warning form-control" download> Download Document</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="loader">
                            <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                        </div>
                        <a href="{{route('HeadTeam.profile')}}" class="btn btn-danger" >Kembali <i class="icon-backspace2 position-right"></i></a>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Submit <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
                </div>
            </div>

        </div>
        <!-- /main content -->

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
@elseif(Session('error'))
<script>
    swal("Upps, Sorry", "{!! Session::get('error') !!}", "warning");
</script>
@endif

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
@endsection