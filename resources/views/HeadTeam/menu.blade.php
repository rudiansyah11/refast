<!-- TITLE  -->
@section('title', 'Menu Portal Refast Indo')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default sidebar-separate">
            <div class="sidebar-content">

                <!-- User details -->
                <div class="content-group">
                    <div class="panel-body bg-slate-700 border-radius-top text-center">

                        <a href="#" class="display-inline-block content-group-sm" style="pointer-events: none">
                            <!--<img src="{{ asset('assets/images/user_default.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">-->
                            <img src="{{ asset('storage/uploads/photoProfile/'.Auth::user()->photo_profile) }}" alt="photo profile" class="img-circle img-responsive" style="width: 110px; height: 110px;">
                        </a>
                        <div class="content-group-sm">
                            <h6 class="text-semibold no-margin-bottom">
                                {{ Auth::user()->name }}
                            </h6>
                            <span class="display-block">{{ $datanya['user_contract']->level_employee }}</span>
                        </div>
                    </div>
                    
                </div>
                <!-- /user details -->

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Tab content -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="profile">

                    <!-- Profile info -->
                    <div class="panel panel-success panel-bordered">
                        <div class="panel-heading">
                            <h6 class="panel-title">Welcome, <b>{{ Auth::user()->name }}</b></h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="text-muted text-center">FOR BAR CHART</h4>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="text-muted text-center">FOR DONUT CHART</h4>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /profile info -->

                    <!-- Account settings -->
                    <div class="panel panel-info panel-bordered">
                        <div class="panel-heading">
                            <h6 class="panel-title"><b>Menu</b></h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">

                                <div class="col-sm-6 col-md-3">
                                    <a href="{{ route('HeadTeam.rugilaba') }}">
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Rugi Laba</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class="icon-calculator3 icon-2x text-indigo-400 opacity-75"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a href="{{ route('HeadTeam.penjualan') }}">
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Penjualanan</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class="icon-cart-add2 icon-2x text-indigo-400 opacity-75"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a href="{{ route('HeadTeam.invoice') }}">
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Invoice</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class="icon-info3 icon-2x text-indigo-400"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a href="{{ route('HeadTeam.kasbon') }}">
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Kasbon</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class="icon-cash icon-2x text-indigo-400"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a href="" data-toggle="modal" data-target="#show_absen_masuk">
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Absen Masuk</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class="icon-hand icon-2x text-indigo-400 opacity-75"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Modal Absen Masuk -->
                                <div id="show_absen_masuk" class="modal fade">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h5 class="modal-title">Pilih Absen</h5>
                                            </div>

                                            <form method="GET" action="{{route('HeadTeam.buatabsen')}}">

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-4">Pilih: <span class="text-danger">*</span> </label>
                                                            <div class="col-lg-8">
                                                                <select name="jenis_absen" id="jenis_absen" class="form-control">
                                                                    <option value="masuk">Masuk</option>
                                                                    <option value="tidak_masuk">Tidak Masuk</option>
                                                                </select>

                                                                <input type="text" name="latitude_absen" id="latitude_absen">
                                                                <input type="text" name="longitude_absen" id="longitude_absen">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>

                                        </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /small modal -->

                                <div class="col-sm-6 col-md-3">
                                    <a href="" data-toggle="modal" data-target="#show_absen_pulang">
                                    <!-- <a href="{{route('HeadTeam.absenpulang')}}"> -->
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Absen Pulang</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class=" icon-exit3 icon-2x text-indigo-400 opacity-75"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Modal Absen Pulang -->
                                <div id="show_absen_pulang" class="modal fade">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h5 class="modal-title">Pilih Absen Pulang</h5>
                                            </div>

                                            <form method="GET" action="{{route('HeadTeam.absenpulang')}}">

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-4">Pilih: <span class="text-danger">*</span> </label>
                                                            <div class="col-lg-8">
                                                                <select name="jenis_absen" id="jenis_absen" class="form-control">
                                                                    <option value="office">Office</option>
                                                                    <option value="project">Project</option>
                                                                    <option value="lainnya">Lainnya</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>

                                        </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /small modal -->

                                <div class="col-sm-6 col-md-3">
                                    <a href="{{route('HeadTeam.dev_checkpoint')}}">
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Check Point</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class="icon-arrow-right16 icon-2x text-indigo-400"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a href="{{ route('HeadTeam.data_customer') }}">
                                        <div class="panel panel-body">
                                            <div class="media no-margin-top content-group">
                                                <div class="media-body">
                                                    <h6 class="no-margin text-semibold">Data Customer</h6>
                                                    <span class="text-muted">Click Here</span>
                                                </div>

                                                <div class="media-right media-middle">
                                                    <i class="icon-user-tie icon-2x text-indigo-400"></i>
                                                </div>
                                            </div>

                                            <div class="progress progress-micro mb-10">
                                                <div class="progress-bar bg-indigo-400" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /account settings -->
                </div>

            </div>
            <!-- /tab content -->

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

<!-- Get longlat untuk modal di absen masuk  -->
<script>
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

@endsection