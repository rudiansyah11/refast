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
                        Tombol <b>Absen Out</b> Hanya bisa di klik ketika sudah berkerja dia atas 8 jam.
                    </div>
                    <div class="row">
                        <?php
                            // check for button submit, untuk disabled buttonnya ada di JS bawah..
                            // $check_datanya = $check_absen->count() ;
                            // if( !empty($check_absen) ){
                            //     if( is_null($check_absen->end_date) ){
                            //         // kalo udh absen masuk tapi blm absen keluar
                            //         $btn_masuk = "disabled";
                            //         $btn_keluar = "";

                            //     } else {
                            //         // kalo udh absen masuk & keluar
                            //         $btn_masuk = "disabled";
                            //         $btn_keluar = "disabled";
                            //     }
                            
                            // } else {
                            //     // kalo blm absen sama sekali
                            //     $btn_masuk = "";
                            //     $btn_keluar = "disabled";
                            // }

                        ?>
                        <div class="col-md-6">
                            <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.processAbsent') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="username">
                                <input type="hidden" value="entry" name="today">

                                <div class="text-center">
                                    <div class="loader">
                                        <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                    </div>
                                    <button class="btn btn-block btn-danger btn-lg" id="btn-submit"><i class="icon-enter2 position-right"></i> Absent Entry</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.processAbsent') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="username">
                                <input type="hidden" value="out" name="today">
                                <input type="hidden" value="<?= date('Y-m-d')?>" name="hari">

                                <div class="text-center">
                                    <div class="loader-out">
                                        <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                    </div>
                                    <button class="btn btn-block btn-info btn-lg" id="btn-submit-out"><i class="icon-exit3 position-right"></i> Absent Out</button>
                                </div>
                            </form>
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
    // if($btn_masuk == "disabled"){
    //     echo '<script>$("#btn-submit").prop("disabled", true);</script>';
    // }

    // if($btn_keluar == "disabled"){
    //     echo '<script>$("#btn-submit-out").prop("disabled", true);</script>';
    // }
?>


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