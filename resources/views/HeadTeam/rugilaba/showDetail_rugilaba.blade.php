<!-- TITLE  -->
@section('title', 'Detail Rugi Laba')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<!-- Page header -->

<style type="text/css">
    .loader{
        display: none;
    }
</style>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Rugi Laba - Detail</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text" style="pointer-events: none; display: inline-block;">
                    <i class="icon-file-excel text-primary"></i> <span>Export to ?</span>
                </a>
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

            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title"> DETAIL RUGI LABA: {{ $datanya['data_rl']->project_number }}</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="panel-body">
                            <form class="form-horizontal" id="form-submit">
                                <fieldset class="content-group">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Project Number</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ $datanya['data_rl']->project_number }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Nama Customer</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ $datanya['data_rl']->nama_customer }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">PO Number</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ $datanya['data_rl']->po_number }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">PO Date</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="date" class="form-control form-group-xs bg-slate text-default" value="{{ $datanya['data_rl']->po_date }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">PO Category</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ $datanya['data_rl']->po_category }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-4">PO Nominal</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ number_format($datanya['data_rl']->po_nominal, 0, '.', '.') }}" id="po_nominal" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Nominal Pemasukan</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ number_format($datanya['data_rl']->total_pemasukan, 0, '.', '.') }}" id="total_pemasukan" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Nominal Pemasukan + PPN 11%</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ number_format($datanya['data_rl']->total_pemasukan_with_ppn11, 0, '.', '.') }}" id="total_pemasukan_with_ppn11" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Nominal Tersisa</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default"value="{{ number_format($datanya['data_rl']->sisa_nominal, 0, '.', '.') }}" id="sisa_nominal" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Nominal Pengeluaran (COST)</label>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon bg-slate-700"><i class="icon-lock2"></i></span>
                                                        <input type="text" class="form-control form-group-xs bg-slate text-default" value="{{ number_format($datanya['data_rl']->total_pengeluaran, 0, '.', '.') }}" id="total_pengeluaran" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <div class="text-right mb-3">
                                    <a href="{{route('HeadTeam.rugilaba')}}" class="btn btn-danger" >Kembali <i class="icon-backspace2 position-right"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">INVOICES</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                
                                <div class="panel-body table-responsive">
                                    <div class="row" style="margin-top:15px;">
                                        <div class="col-md-12">
                                            <a href="{{route('HeadTeam.buatinvoice_sisa', $datanya['data_rl']->project_number)}}" class="btn btn-sm btn-info">Tambah Invoice baru</a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px; margin-buttom:10px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="progress">
                                                    <?php
                                                    $color = '';
                                                    if($datanya['data_rl']->proses_pembayaran <= 49){
                                                        $color = 'danger';
                                                    } else if($datanya['data_rl']->proses_pembayaran >= 50 && $datanya['data_rl']->proses_pembayaran <= 90){
                                                        $color = 'warning';
                                                    } else if($datanya['data_rl']->proses_pembayaran >= 91 ){
                                                        $color = 'success';
                                                    }
                                                    ?>
                                                    <div class="progress-bar progress-bar-striped active progress-bar-<?= $color;?>" style="width: {{$datanya['data_rl']->proses_pembayaran}}%">
                                                        <span>{{$datanya['data_rl']->proses_pembayaran}}% Proses Pembayaran</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped">
                                                <thead class="bg-success">
                                                    <tr>
                                                        <th class="text-center">No.INVOICE</th>
                                                        <th class="text-center">Amount</th>
                                                        <th class="text-center">Status Invoices</th>
                                                        <th class="text-center">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
        
                                                @if( $datanya['data_invoice']->isEmpty() )
                                                    <tr>
                                                        <td colspan="3"><h5 class="text-muted">Invoicenya belum dibuat!</h5></td>
                                                    </tr>
                                                @else
                                                    @foreach($datanya['data_invoice'] as $row)
                                                        <tr>
                                                            <td>{{ $row->no_invoice }}</td>
                                                            <td>{{ number_format($row->subtotal, 0, '.', '.') }}</td>
                                                            <td>
                                                                <?php $row->status_invoice
                                                                ?>
                                                            @if($row->status_invoice == 'New')
                                                                <span class="label label-warning">Baru dibuat</span>
                                                            @elseif($row->status_invoice == 'Sent')
                                                                <span class="label label-info">Terkirim</span>
                                                            @elseif($row->status_invoice == 'paid_off')
                                                                <span class="label label-success">Terbayar/Lunas</span>
                                                            @else
                                                                <span class="label label-danger">Cancel</span>
                                                            @endif
                                                            </td>
                                                            <td><a href="{{ route('HeadTeam.editinvoice', $row->passing_id);}}" class="btn btn-rounded btn-xs btn-success" target="_blank">Lihat</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">LIST BARANG</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                
                                <div class="panel-body table-responsive">
                                    <table class="table table-striped" style="margin-top:10px;">
                                        <thead class="bg-slate-700">
                                            <tr>
                                                <th class="text-center">Deskripsi</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Harga Unit</th>
                                                <th class="text-center">Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">

                                        @if( $datanya['data_barang']->isEmpty() )
                                            <tr>
                                                <td colspan="4"><h5 class="text-muted">Data Barang tidak ditemukan!</h5></td>
                                            </tr>
                                        @else
                                            @foreach($datanya['data_barang'] as $row)
                                                <tr>
                                                    <td>{{ $row->deskripsi }}</td>
                                                    <td>{{ $row->quantity }}</td>
                                                    <td>{{ number_format($row->harga_unit, 0, '.', '.') }}</td>
                                                    <td>{{ number_format($row->total_harga, 0, '.', '.') }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" style="text-align:end;"><b>SUBTOTAL:</b></td>
                                                <td><b class="text-info">{{ number_format($datanya['subtotal'], 0, '.', '.') }}</b></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Pengeluaran (Cost)</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="panel-body table-responsive">
                            <table class="table table-striped" style="margin-top:10px;">
                                <thead class="bg-slate-700">
                                    <tr>
                                        <th class="text-center">COST MATERIAL</th>
                                        <th class="text-center">COST JASA</th>
                                        <th class="text-center">COST LAINNYA</th>
                                        <th class="text-center">TOTAL COST</th>
                                        <th class="text-center">TOTAL PROFIT</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                @if( $datanya['data_cost']->isEmpty() )
                                    <tr>
                                        <td colspan="4"><h5 class="text-muted">Upps Sorry, Data Cost nya belum ada!</h5></td>
                                    </tr>
                                @else
                                    @foreach($datanya['data_cost'] as $row)
                                        <?php
                                            $subtotal_cost = $row->cost_material + $row->cost_jasa + $row->cost_lainnya;
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="https://inventory.refastindo.com/test_integration.php?log={{ Auth::user()->name }}&pry={{ $datanya['data_rl']->project_number }}" target="blank">
                                                Rp. {{ number_format($row->cost_material, 0, '.', '.') }}
                                                </a>
                                            </td>
                                            <td>Rp. {{ number_format($row->cost_jasa, 0, '.', '.') }}</td>
                                            <td>Rp. {{ number_format($row->cost_lainnya, 0, '.', '.') }}</td>
                                            <td>Rp. {{ number_format($subtotal_cost, 0, '.', '.') }}</td>
                                            <td> 
                                                <?php
                                                $profit = $datanya['data_rl']->po_nominal - $subtotal_cost;

                                                if($profit >= 0){?>
                                                    <p class="text-info"><i class="icon-arrow-up7"></i> Rp.{{ number_format($profit, 0, '.', '.') }} </p>

                                                <?php } else { ?>
                                                    <p class="text-danger"><i class="icon-arrow-down7"></i> Rp.{{ number_format($profit, 0, '.', '.') }} </p>

                                                <?php } ?>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
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

        // var po_nominal = document.getElementById('po_nominal');
        // po_nominal.addEventListener('keyup', function(e) {
        //     po_nominal.value = formatRupiah(this.value);
        // });

        // var total_pemasukan = document.getElementById('total_pemasukan');
        // total_pemasukan.addEventListener('keyup', function(e) {
        //     total_pemasukan.value = formatRupiah(this.value);
        // });

        // var total_pemasukan_with_ppn11 = document.getElementById('total_pemasukan_with_ppn11');
        // total_pemasukan_with_ppn11.addEventListener('keyup', function(e) {
        //     total_pemasukan_with_ppn11.value = formatRupiah(this.value);
        // });

        // var sisa_nominal = document.getElementById('sisa_nominal');
        // sisa_nominal.addEventListener('keyup', function(e) {
        //     sisa_nominal.value = formatRupiah(this.value);
        // });

        // var total_pengeluaran = document.getElementById('total_pengeluaran');
        // total_pengeluaran.addEventListener('keyup', function(e) {
        //     total_pengeluaran.value = formatRupiah(this.value);
        // });

        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

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

@endsection