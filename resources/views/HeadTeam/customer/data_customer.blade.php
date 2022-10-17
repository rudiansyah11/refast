<!-- TITLE  -->
@section('title', 'Data Customer')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<style type="text/css">
    .loader{
        display: none;
    }
    table { 
        table-layout: auto; 
        width: 100%;
    }
    th {
        font-size:10px;
        background-color:#28343a;
        color:white;
        font-weight:bold;
        height:40px;
    }
    tr > td {
        font-size:11px;
        height:50px;
        width:260px;
    }
</style>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Customer</span> - Show All</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <!-- <a href="#" class="btn btn-link btn-float has-text">
                    
                </a> -->
                <a href="#" class="btn btn-link btn-float has-text" data-toggle="modal" data-target="#input_customer"> 
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

<!-- Modal Input -->
<div id="input_customer" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h6 class="modal-title">Data Customer</h6>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.prosescustomeradd') }}" method="POST">
                    <fieldset class="content-group">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @error('customer_name') has-warning has-feedback @enderror">
                                    <label class="control-label col-lg-4">Nama Customer: <span class="text-danger">*</span> </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="customer_name" required placeholder="Mohon untuk mengisi Nama Pelanggan..">
                                        @error('customer_name')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('alamat_customer') has-warning has-feedback @enderror">
                                    <label class="control-label col-lg-4">Alamat Customer: <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <textarea rows="2" name="alamat_customer" id="alamat_customer" class="form-control" required placeholder="Mohon untuk mengisi alamat jalan pelanggan..">{{ old('alamat_customer') }}</textarea>
                                        @error('alamat_customer')
                                            <div class="form-control-feedback">
                                                <i class="icon-notification2"></i>
                                            </div>
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('alamat_customer1') has-warning has-feedback @enderror">
                                    <label class="control-label col-lg-4">Kec & Kota & Kode POS: <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <textarea rows="2" name="alamat_customer1" id="alamat_customer1" class="form-control" required placeholder="Mohon untuk mengisi Kecamatan dan nama kota..">{{ old('alamat_customer1') }}</textarea>
                                        @error('alamat_customer1')
                                            <div class="form-control-feedback">
                                                <i class="icon-notification2"></i>
                                            </div>
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group @error('deskripsi_customer') has-warning has-feedback @enderror">
                                    <label class="control-label col-lg-4">Info Lain: <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <textarea rows="2" name="deskripsi_customer" id="deskripsi_customer" class="form-control" required placeholder="Informasi tambahan seperti nama gedung, lantai, no tlp atau fax">{{ old('deskripsi_customer') }}</textarea>
                                        @error('deskripsi_customer')
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
                            <img src="{{ asset('assets/spinner/spinner.gif') }}" style="width: 65px; height: 60px;">
                        </div>
                    </div>
                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Data All Customer</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    
                    <table class="table datatable-responsive-control-right table-bordered table-striped"> 
                        <thead>
                            <tr>
                                <th class="text-center">NAMA CUSTOMER</th>
                                <th class="text-center">JALAN</th>
                                <th class="text-center">KEC & KOTA</th>
                                <th class="text-center">INFO LAIN</th>
                                <th class="text-center">Action</th>
								<th></th>
							</tr>
                        </thead>
                        <tbody>
                            @foreach($data_cust as $row)
                            <tr class="text-center">
								<td>{{ $row->nama_customer }}</td>
								<td>{{ $row->address_customer }}</td>
								<td>{{ $row->address_customer1 }}</td>
                                <td>{{ $row->deskripsi_customer }}</td>
                                <td style="height:50px;width:120px;">
                                    <a href="{{ route('HeadTeam.edit_customer', $row->id)}}" class="btn btn-xs bg-purple-700"><span class="icon-database-edit2"></span></a>
                                    <a href="{{route('HeadTeam.hapusdatacustomerproses', $row->id)}}" onclick="return confirm('Are you sure you want to Delete this?');" class="btn btn-warning btn-xs" ><i class="icon-trash-alt"></i></a>
                                </td>
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