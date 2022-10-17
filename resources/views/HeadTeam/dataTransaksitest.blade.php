<!-- TITLE  -->
@section('title', 'Sample Page')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Datatables</span> - Responsive</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-stats-bars text-primary"></i><span>Dashboard</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-box-add text-primary"></i> <span>Create New Data</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text">
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
                    <h5 class="panel-title">Data All Transaction</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    When using the <code>column</code> details type in Responsive the <code>responsive.details.target</code> option provides the ability to control what element is used to show/hide the child rows when the table is collapsed. This example uses the <code>tr</code> selector to have the whole row act as the control.
                    <hr>
                    <table class="table datatable-responsive-control-right table-bordered table-striped"> 
                        <thead>
                            <tr>
                                <th class="text-center">Nama Pembeli</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Status Pembelian</th>
                                <th class="text-center">Tanggal Beli</th>
                                <th class="text-center">Action</th>
								<th></th>
							</tr>
                        </thead>
                        <tbody>
                            @foreach($datanya as $row)
                            <tr class="text-center">
								<td>{{ $row->name_buyer }}</td>
								<td>{{ $row->nama_barang }}</td>
								<td>{{ $row->quantity }}</td>
								<td>
                                    @if($row->status_pembelian == "Request")
                                        <?php $color = "bg-info-600";?>
                                    @elseif($row->status_pembelian == "Done")
                                        <?php $color = "bg-success-400";?>
                                    @else
                                        <?php $color = "bg-danger-600";?>
                                    @endif
                                    <span class="label {{$color}}">{{ $row->status_pembelian }}</span>
                                </td>
								<td>{{ $row->created_at }}</td>
                                <td><a href="{{ route('HeadTeam.buyingExecute', ['passing_id_buying'=>$row->passing_id_buying,'passing_id_barang'=>$row->passing_id_barang]) }}" class="btn btn-xs bg-purple-700"><span class="icon-drawer-out"> Execute</span></a></td>
								<td></td>
							</tr>
							@endforeach
                        </tbody>
                    </table>
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

        $('.datatable-responsive').DataTable();
    });
</script>
@endsection