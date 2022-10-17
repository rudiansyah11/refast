<!-- TITLE  -->
@section('title', 'Menu Penjualanan')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<!-- Page header -->

<style type="text/css">
    table { 
        table-layout: auto; 
        width: 100%;
    }
    th {
        white-space: nowrap; 
        text-align:center;
        font-size:10px;
        background-color:#28343a;
        color:white;
        font-weight:bold;
        height:40px;

    }
    td {
        white-space: nowrap; 
        text-align:center;
        font-size:11px;
    }
    .btn-group {
        white-space: nowrap; 
        width:80px;
    }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Invoice</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="{{ route('HeadTeam.buatinvoice') }}" target="_blank" class="btn btn-link btn-float has-text">
                    <i class="icon-file-text3 text-primary"></i> <span>Buat Invoice Baru</span>
                </a>
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

            <div class="panel">
                <div class="panel-heading">
                    <h6 class="panel-title"><b>Data Invoices</b></h6>
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

                        <!-- baru dibuat atau new -->
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('HeadTeam.sortinvoice', 'New') }}" target="_blank">
                                <div class="panel panel-body">
                                    <div class="media no-margin-top content-group">
                                        <div class="media-body">
                                            <h6 class="no-margin text-semibold"><span class="label label-warning">Baru dibuat</span></h6>
                                            <span class="text-muted">IDR {{ number_format($datanya['nominal_data_new'], 0, '.', '.') }}</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <h5 class="text-indigo-400 opacity-75">{{ $datanya['data_new'] }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- terkirim atau Sent -->
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('HeadTeam.sortinvoice', 'Sent') }}" target="_blank">
                                <div class="panel panel-body">
                                    <div class="media no-margin-top content-group">
                                        <div class="media-body">
                                            <h6 class="no-margin text-semibold"><span class="label label-info">Terkirim</span></h6>
                                            <span class="text-muted">IDR {{ number_format($datanya['nominal_data_sent'], 0, '.', '.') }}</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <h5 class="text-indigo-400 opacity-75">{{ $datanya['data_sent'] }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Lunas/Terbayar atau paid_off -->
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('HeadTeam.sortinvoice', 'paid_off') }}" target="_blank">
                                <div class="panel panel-body">
                                    <div class="media no-margin-top content-group">
                                        <div class="media-body">
                                            <h6 class="no-margin text-semibold"><span class="label label-success">Lunas/Terbayar</span></h6>
                                            <span class="text-muted">IDR {{ number_format($datanya['nominal_data_paid_off'], 0, '.', '.') }}</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <h5 class="text-indigo-400 opacity-75">{{ $datanya['data_paid_off'] }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Keseluruhan -->
                        <div class="col-sm-6 col-md-3">
                            <a href="{{ route('HeadTeam.invoice') }}">
                                <div class="panel panel-body">
                                    <div class="media no-margin-top content-group">
                                        <div class="media-body">
                                            <h6 class="no-margin text-semibold"><span class="label label-danger">Total Keseluruhan</span></h6>
                                            <span class="text-muted">IDR {{ number_format($datanya['nominal_data_keseluruhan'], 0, '.', '.') }}</span>
                                        </div>

                                        <div class="media-right media-middle">
                                            <h5 class="text-indigo-400 opacity-75">{{ $datanya['data_keseluruhan'] }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Show Data All Invoice</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-xs table-bordered table-striped">
						<thead class="text-center">
							<tr>
                                <th>NO INVOICE</th>
                                <th>PROJECT NUMBER</th>
                                <th>CUSTOMER</th>
                                <th>DESCRIPTION </th>
                                <th>LOCATION </th>
                                <th>PO AMOUNT </th>
								<th>INVOICE AMOUNT </th>
								<th>PROCESS (%)</th>
                                <th>STATUS INVOICE</th>
                                <th>PO NUMBER</th>
                                <th>KETERANGAN</th>
                                <th>CATEGORY</th>
								<th>NOMINAL PPN11</th>
								<th>NOMINAL WITH PPN</th>
                                <th>Act</th>
							</tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@if(Session('success'))
<script>
    swal("Great Jobs :)", "{!! Session::get('success') !!}", "success");
</script>
@elseif(Session('error'))
<script>
    swal("Upps, Sorry", "{!! Session::get('error') !!}", "warning");
</script>
@endif


<!-- ServerSide DataTables -->
<!-- DataTables -->
<!-- <script>
    $('.datatable-scroll-y').DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        scrollX: true
    });
</script> -->

<!-- ServerSide DataTables -->
<!-- DataTables -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    $(function () {

        var table = $('.table').DataTable({
            buttons: {            
                buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                        className: 'btn bg-blue btn-icon'
                    }
                ]
            },
            destroy: true,
            searching: true,
            processing: true,
            serverSide: true,
            scrollY: 300,
            scrollX:true,
            ajax: "{{ route('HeadTeam.getInvoices') }}",
            columns: [
                {data: 'no_invoice', name: 'invoices.no_invoice', width:'7%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/editinvoice/`+row.passing_id+`" class="text-muted text-bold"><u> `+row.no_invoice+`<u></a>`;
                    }
                },
                {data: 'project_number', name: 'invoices.project_number', width:'7%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/editinvoice/`+row.passing_id+`" class="text-muted text-bold"><u> `+row.project_number+`<u></a>`;
                    }
                },
                {data: 'nama_customer', name: 'invoices.nama_customer', width:'20%'},
                {data: 'deskripsi', name: 'penjualans.deskripsi', width:'20%'},
                {data: 'lokasi', name: 'penjualans.lokasi', width:'20%'},
                {data: 'nominal_pembayaran', name: 'invoices.nominal_pembayaran', width:'15%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'subtotal', name: 'invoices.subtotal', width:'15%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'proses_percent', name: 'proses_percent', width:'7%', render: function (data, type, row) {
                    if (row.create_manual == 'Yes') {
                        return `<span class="label label-danger">`+row.proses_percent+`%</span>`;
                    } else {
                        return data+'%';
                    }
                    }
                },
                {data: 'status_invoice', name: 'invoices.status_invoice', width:'10%', render: function (data) {
                    if (data == 'New') {
                        return `<span class="label label-warning">Baru dibuat</span>`;
                    } else if(data == 'Sent') {
                        return `<span class="label label-info">Terkirim</span>`;
                    } else {
                        return `<span class="label label-success">Lunas/Terbayar</span>`;
                    }
                    }
                },
                {data: 'po_number', name: 'invoices.po_number', width:'7%'},
                {data: 'keterangan', name: 'invoices.keterangan', width:'25%'},
                {data: 'proses_category', name: 'invoices.proses_category', width:'5%'},
                {data: 'nominal_ppn11', name: 'invoices.nominal_ppn11', width:'15%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'nominal_pembayaran_with_ppn11', name: 'nominal_pembayaran_with_ppn11', width:'15%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'action', name: 'action', width:'10%'}
            ]
        });

    });
</script>
@endsection