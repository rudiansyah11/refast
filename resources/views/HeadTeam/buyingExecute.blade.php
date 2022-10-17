<!-- TITLE  -->
@section('title', 'Tester Execute Buying')

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

        <!-- Main content -->
        <div class="content-wrapper">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Process Data Buying<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">

                    <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.processExecute') }}" method="POST">
                        <fieldset class="content-group">
                            <!-- <legend class="text-bold">Edit Barang</legend> -->
                            @csrf
                            <!-- inputhideen untuk log -->
                            <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                            <input type="hidden" value="{{ $datanya['data_request']->passing_id_buying; }}" name="passing_id_buying">
                            <input type="hidden" value="{{ $datanya['data_request']->passing_id_barang; }}" name="passing_id_barang">
                            <input type="hidden" value="{{ $datanya['data_request']->nama_barang; }}" name="nama_barang">
                            <input type="hidden" value="{{ $datanya['data_request']->quantity; }}" name="quantity">
                            <!-- inputhideen untuk update data -->
                            <input type="hidden" value="{{ $datanya['data_sampel']->stok_barang; }}" name="stock">

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <p class="content-group-lg">
                                        Data request execiton, dengan nama barang: <code>{{ $datanya['data_request']->nama_barang; }}</code>
                                    </p>
                                    <hr>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Nama Pembelian</td>
                                            <td>{{ $datanya['data_request']->name_buyer; }}</td>
                                        </tr>
                                        <tr>
                                            <td>Quantity Pembelian</td>
                                            @if($datanya['data_request']->quantity > $datanya['data_sampel']->stok_barang)
                                            <td style="background:#F44336;">{{ $datanya['data_request']->quantity; }}</td>
                                            @else
                                            <td style="background:#66BB6A;">{{ $datanya['data_request']->quantity; }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Status Pembelian</td>
                                            <td>
                                                @if($datanya['data_request']->status_pembelian == "Request")
                                                    <?php $color = "bg-info-600";?>
                                                @elseif($datanya['data_request']->status_pembelian == "Done")
                                                    <?php $color = "bg-success-400";?>
                                                @else
                                                    <?php $color = "bg-danger-600";?>
                                                @endif
                                                <span class="label {{$color}}">{{ $datanya['data_request']->status_pembelian }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TGL Pembelian</td>
                                            <td>{{ $datanya['data_request']->created_at; }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <p class="content-group-lg">
                                        Data Sampel Item saat ini tersedia
                                    </p>
                                    <hr>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>{{ $datanya['data_sampel']->nama_barang; }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stock Barang</td>
                                            @if($datanya['data_request']->quantity > $datanya['data_sampel']->stok_barang)
                                            <td style="background:#F44336;">{{ $datanya['data_sampel']->stok_barang; }}</td>
                                            @else
                                            <td>{{ $datanya['data_sampel']->stok_barang; }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Harga Satuan</td>
                                            <td>{{ $datanya['data_sampel']->harga_satuan; }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Barang</td>
                                            <td>{{ $datanya['data_sampel']->jenis_barang; }}</td>
                                        </tr>
                                        <tr>
                                            <td>Submitter</td>
                                            <td>{{ $datanya['data_sampel']->creator; }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <hr class="my-2">
                            <div class="alert alert-warning alert-styled-left alert-arrow-left alert-component">
                                <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                                <h6 class="alert-heading text-semibold">NOTE:</h6>
                                - Dibawah ini adalah proses execute pembelian barang, yg mana jika kita pilih status <code>Done</code> maka stok yg saat ini tersedia akan berkurang menyesuaikan quantity yg di proses. <br>
                                - Jika kita ingin memiliih status <code>Cancel</code>, maka stok tidak akan berkurang, dan order atau pembelian akan dibatalkan.<br>
                                - Jika kita pilih status <code>Reject</code> yg mana status <code>Reject</code> ini hanya bisa dilakukan ketika status sebelumnya <b>DONE</b>, yg mana jika status <code>Reject</code> kita pilih maka stok yg saat ini sudah berkurang, akan dikembalikan atau ditamban sesuai dengan quantity yg di order atau dibeli.
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('statusnya') has-warning has-feedback @enderror">
                                        <label class="control-label col-lg-4">Execution Status</label>
                                        <div class="col-lg-8">
                                            <select name="statusnya" class="form-control input-xs @error('statusnya') is-invalid @enderror">
                                                @if($datanya['data_request']->status_pembelian == "Request")
                                                <option value="Request" selected>Request</option>
                                                <option value="Done">Done</option>
                                                <option value="Cancel">Cancel</option>
                                                @elseif($datanya['data_request']->status_pembelian == "Done")
                                                <option value="Request">Request</option>
                                                <option value="Done" selected>Done</option>
                                                <option value="Cancel">Cancel</option>
                                                <option value="Reject">Reject</option>
                                                @elseif($datanya['data_request']->status_pembelian == "Cancel")
                                                <option value="Request">Request</option>
                                                <option value="Done">Done</option>
                                                <option value="Cancel" selected>Cancel</option>
                                                @endif

                                                @error('statusnya')
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </select>
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