<!-- TITLE  -->
@section('title', 'Absen Masuk')

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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Absent</span> - Masuk & Keluar</h4>
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
                    <h6 class="panel-title">Absent Masuk & Keluar</h6>
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
                        - Absent terdiri dari 3 jenis absent (Masuk, Tidak Masuk, Pulang) <br>
                        - Absent Masuk : <b>Office, Project, Lainnya</b><br>
                        - Absent Tidak Masuk : <b>Cuti, Izin, Sakit</b><br>
                        - Absent Pulang : untuk pulang<br>
                        - Silahkan klik Tombol <b>Pilih Absent</b> untuk melakukan absent.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-info" id="accesscamera" data-toggle="modal" data-target="#absent-entry"><i class=" icon-redo2 position-right"></i> Pilih Absent</button>
                            
                            <!-- Full Modal Absent Entry -->
                            <div id="absent-entry" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h5 class="modal-title">Pilih Absent</h5>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <form method="GET" action="{{route('HeadTeam.do_abenst')}}">
                                                @csrf
                                                <div class="col-md-12 form-group">
                                                    <label>Jenis Absent:</label>
                                                    <select name="jenis_absent" class="form-control" required>
                                                        <option value="">---</option>
                                                        <option value="absent_masuk">Absent Masuk</option>
                                                        <option value="absen_tidak_masuk">Absent Tidak Masuk</option>
                                                        <option value="absent_pulang">Absent Pulang</option>
                                                    </select>
                                                </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal" id="close_modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary mx-auto text-white d-none">Pilih</button>
                                            <div class="loader">
                                                <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Full Modal Absent Entry -->
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