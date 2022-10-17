<!-- TITLE  -->
@section('title', 'Menu Kasbon')

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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Kasbon</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="{{ route('HeadTeam.create_kasbon', 'kasbon') }}" class="btn btn-link btn-float has-text">
                    <i class="icon-box-add text-primary"></i> <span>Buat Kasbon</span>
                </a>
                <a href="{{ route('HeadTeam.create_kasbon', 'settlement') }}" class="btn btn-link btn-float has-text">
                    <i class="icon-box-add text-primary"></i> <span>Buat Settlement</span>
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
                    <h5 class="panel-title">Show Data Kasbon</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row col-md-12 table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>PIC</th>
                                    <th>NO KASBON</th>
                                    <th>TOTAL AMOUNT</th>
                                    <th>OVER OR UNDER</th>
                                    <th>NOMINAL RESULT</th>
                                    <th>STATUS</th>
                                    <th>CATEGORY</th>
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
            ajax: "{{ route('HeadTeam.getKasbon') }}",
            columns: [
                {data: 'pic', name: 'pic', width:'7%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/editkasbon/`+row.passing_id+`" class="text-muted text-bold"><u> `+row.pic+`<u></a>`;
                    }
                },
                {data: 'no_kasbon', name: 'no_kasbon', width:'7%', render: function (data, type, row) {
                        return `<a href="/HeadTeam/editkasbon/`+row.passing_id+`" class="text-muted text-bold"><u> `+row.no_kasbon+`<u></a>`;
                    }
                },
                {data: 'total_amount', name: 'total_amount', width:'15%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'over_under', name: 'over_under', width:'20%'},
                {data: 'resultnya', name: 'resultnya', width:'15%', render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp. ')},
                {data: 'statusnya', name: 'statusnya', width:'10%', render: function (data) {
                    if (data == 'Open') {
                        return `<span class="label label-danger">OPEN</span>`;
                    } else {
                        return `<span class="label label-success">CLOSE</span>`;
                    }
                    }
                },
                {data: 'categorynya', name: 'categorynya', width:'7%'},
                {data: 'date_kasbon', name: 'date_kasbon', width:'25%', render: $.fn.dataTable.render.moment('YYYY-MM-DD HH:mm:ss','D - MMMM - YY' )},
                {data: 'action', name: 'action', width:'10%'}
            ]
        });

    });
</script>
@endsection