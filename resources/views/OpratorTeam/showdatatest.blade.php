<!-- TITLE  -->
@section('title', 'Tester Show Data')

<!-- EXTENTION WITH HEADER  -->
@extends('OpratorTeam.headers_oprators')

<!-- REQUIRE PAGE  -->
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">ServerSide DataTable's</span> - Sample Show Data</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="{{ route('HeadTeam.dashboard_dev_1') }}" class="btn btn-link btn-float has-text">
                    <i class="icon-stats-bars text-primary"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('HeadTeam.testerinput') }}" class="btn btn-link btn-float has-text">
                    <i class="icon-box-add text-primary"></i> <span>Create New Data</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-file-excel text-primary"></i> <span>Export All</span>
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
                    <h5 class="panel-title">Tampilkan Semua Data Barang</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    Coba untuk membeli barang tester.
                </div>

                <table class="table datatable-responsive-row-control table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th> <!-- sengaja kosongin -->
                            <th>Nama Barang</th>
                            <th class="text-center">Harga Barang</th>
                            <th class="text-center">Jenis Barang</th>
                            <th class="text-center">Stok Barang</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>

<!-- Loader -->
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
@endif

<!-- DataTables -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
    $(function () {

        var table = $('.datatable-responsive-row-control').DataTable({
            destroy: true,
            searching: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('OpratorTeam.getServerSideTest') }}",
            columns: [
                {data: 'id', name: ''},
                {data: 'nama_barang', name: 'nama_barang'},
                {data: 'harga_satuan', name: 'harga_satuan'},
                {data: 'jenis_barang', name: 'jenis_barang'},
                {data: 'stok_barang', name: 'stok_barang'},
                {data: 'action', name: 'action'},
            ]
        });

    });
</script>
@endsection