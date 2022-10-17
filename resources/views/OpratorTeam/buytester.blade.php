<!-- TITLE  -->
@section('title', 'Tester Buy Data')

<!-- EXTENTION WITH HEADER  -->
@extends('OpratorTeam.headers_oprators')

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

        <!-- Main content -->
        <div class="content-wrapper">

        <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Edit Data Tester<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <p class="content-group-lg">
                            Tester beli barang: <code>{{ $datanya->nama_barang; }}</code>
                        </p>

                        <form class="form-horizontal" id="form-submit" action="{{ route('OpratorTeam.processTestTransksi') }}" method="POST">
                            <fieldset class="content-group">
                                <!-- <legend class="text-bold">Edit Barang</legend> -->
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                <input type="hidden" value="{{ $datanya->passing_id; }}" name="passing_id_barang">
                                <input type="hidden" value="{{ $datanya->nama_barang; }}" name="nama_barang">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nama Barang</label>
                                            <div class="col-lg-9">
                                                <div class="form-control-static">{{ $datanya->nama_barang; }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Stok Barang</label>
                                            <div class="col-lg-9">
                                                <div class="form-control-static">{{ $datanya->stok_barang; }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Harga Barang <span class="text-danger">(Satuan)</span></label>
                                            <div class="col-lg-9">
                                                <div class="form-control-static">{{ $datanya->harga_satuan; }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Jenis Barang</label>
                                            <div class="col-lg-9">
                                                <div class="form-control-static">{{ $datanya->jenis_barang; }}</div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Keterangan</label>
                                            <div class="col-lg-9">
                                                <div class="form-control-static">{{ $datanya->keterangan; }}</div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group @error('quantity') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-2">Quantity</label>
                                            <div class="col-lg-9">
                                                <input type="number" name="quantity" class="form-control input-xs" value="old('quantity') }}">
                                                @error('quantity')
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

        $("#form-submit").submit(function(){
            $("#btn-submit").prop('disabled', true);
            $('.loader').show();
        });

    });
</script>
@endsection