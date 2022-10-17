<!-- TITLE  -->
@section('title', 'Menu Realisasi')

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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Realisasi</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="{{ route('HeadTeam.create_kasbon', 'kasbon') }}" class="btn btn-link btn-float has-text">
                    <i class="icon-box-add text-primary"></i> <span>Buat Realisasi</span>
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
                    <h5 class="panel-title">Show Data Realisasi</h5>
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
                        <div class="col-md-12">
                            <div class="col-sm-6 col-md-3">
                                <a href="#" target="_blank">
                                    <div class="panel panel-body">
                                        <div class="media no-margin-top content-group">
                                            <div class="media-body">
                                                <h6 class="no-margin text-semibold"><span class="label label-success">Total Amount Realisasi</span></h6>
                                                <span class="text-muted">IDR {{ number_format($datanya['total_amount'], 0, '.', '.') }}</span>
                                            </div>

                                            <div class="media-right media-middle">
                                                <h5 class="text-indigo-400 opacity-75">{{ $datanya['total_data'] }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12 table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>PIC</th>
                                    <th>NO REALISASI</th>
                                    <th>NO NOTA</th>
                                    <th>AMOUNT</th>
                                    <th>DATE</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
            destroy: true,
            searching: true,
            processing: true,
            serverSide: true,
            scrollY: 400,
            scrollX:true,
            ajax: "{{ route('HeadTeam.getRealisasi') }}",
            columns: [
                {data: 'pic', name: 'pic', width:'7%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/show_realisasi/`+row.passing_id+`" class="text-muted text-bold"><u> `+row.pic+`<u></a>`;
                    }
                },
                {data: 'no_realisasi', name: 'no_realisasi', width:'7%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/show_realisasi/`+row.passing_id+`" class="text-muted text-bold"><u> `+row.no_realisasi+`<u></a>`;
                    }
                },
                {data: 'no_nota', name: 'no_nota', width:'20%'},
                {data: 'amount', name: 'amount', width:'15%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'created_at', name: 'created_at', width:'7%', render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ','D - MMMM - YY' )},
                {data: 'action', name: 'action', width:'10%'}
            ]
        });

    });
</script>
@endsection