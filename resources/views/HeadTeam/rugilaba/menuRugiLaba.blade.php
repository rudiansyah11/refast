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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Rugi Laba</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text" style="pointer-events: none; display: inline-block;">
                    <i class="icon-stats-bars text-primary"></i><span>Dashboard</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text" style="pointer-events: none; display: inline-block;">
                    <i class="icon-file-excel text-primary"></i> <span>Export to Excel</span>
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

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Show Data Rugi Laba</h5>
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
						<thead>
							<tr class="text-center">
								<th>PROJECT NUMBER</th>
								<th>CUSTOMER</th>
								<th>PO NUMBER</th>
								<th>NOMINAL PO</th>
                                <th>PROSES PEMBAYARAN %</th>
                                <th>TOTAL PEMASUKAN</th>
                                <th>DESCRIPTION</th>
                                <th>LOCATION</th>
                                <th>PROJECT KOORDINATOR</th>
                                <th>SISA NOMINAL</th>
                                <th>TOTAL PEMASUKAN + PPN11%</th>
                                <th>TOTAL PENGELUARAN (COST)</th>
                                <th>PO DATE</th>
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
            scrollX: true,
            destroy: true,
            searching: true,
            processing: true,
            serverSide: false,
            ajax: "{{ route('HeadTeam.getrugilaba') }}",
            columns: [
                {data: 'project_number', name: 'project_number', width:'7%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/editrugilaba/`+row.project_number+`" class="text-muted text-bold"><u> `+row.project_number+`<u></a>`;
                    }
                },
                {data: 'nama_customer', name: 'nama_customer', width:'10%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/editrugilaba/`+row.project_number+`" class="text-muted text-bold"><u> `+row.nama_customer+`<u></a>`;
                    }
                },
                {data: 'po_number', name: 'po_number', width:'5%'},
                {data: 'po_nominal', name: 'po_nominal', width:'5%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'proses_pembayaran', name: 'proses_pembayaran', width:'5%', render: function (data, type, row) {
                        return row.proses_pembayaran+'%';
                    }
                },
                {data: 'total_pemasukan', name: 'total_pemasukan', width:'10%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'deskripsi', name: 'deskripsi', width:'20%'},
                {data: 'lokasi', name: 'lokasi', width:'20%'},
                {data: 'project_koordinator', name: 'project_koordinator', width:'10%'},
                // {data: 'proses_pembayaran', name: 'proses_pembayaran', width:'5%'},
                {data: 'sisa_nominal', name: 'sisa_nominal', width:'10%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'total_pemasukan_with_ppn11', name: 'total_pemasukan_with_ppn11', width:'10%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
				{data: 'total_pengeluaran', name: 'total_pengeluaran', width:'10%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'po_date', name: 'po_date', width:'5%'},
                {data: 'action', name: 'action', width:'10%'}
            ]
        });

    });
</script>

@endsection