<!-- TITLE  -->
@section('title', 'Buat Invoice')

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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">CUSTOMER</span> - EDIT CUSTOMER</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                
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
                <div class="col-lg-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">EDIT DATA CUSTOMER</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="panel-body">
                            <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.prosescustomeredit') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $datanya['data_customer']->id }}" name="id">
                                <fieldset class="content-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group @error('customer_name') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Nama Customer: <span class="text-danger">*</span> </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" name="customer_name" required placeholder="Mohon untuk mengisi Nama Pelanggan.." value="{{ $datanya['data_customer']->nama_customer }}">
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
                                                    <textarea rows="2" name="alamat_customer" id="alamat_customer" class="form-control" required placeholder="Mohon untuk mengisi alamat jalan pelanggan..">{{ $datanya['data_customer']->address_customer }}</textarea>
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
                                                    <textarea rows="2" name="alamat_customer1" id="alamat_customer1" class="form-control" required placeholder="Mohon untuk mengisi Kecamatan dan nama kota..">{{ $datanya['data_customer']->address_customer1 }}</textarea>
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
                                                    <textarea rows="2" name="deskripsi_customer" id="deskripsi_customer" class="form-control" required placeholder="Informasi tambahan seperti nama gedung, lantai, no tlp atau fax">{{ $datanya['data_customer']->deskripsi_customer }}</textarea>
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
                                <div class="text-right mb-3">
                                    <div class="loader">
                                        <img src="{{ asset('assets/spinner/spinner.gif') }}" style="width: 65px; height: 60px;">
                                    </div>
                                    <a href="{{ route('HeadTeam.data_customer') }}" class="btn btn-danger">Kembali <i class="icon-arrow-left13 position-right"></i></a>
                                    <button type="submit" class="btn btn-success" id="btn-submit">Simpan <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
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

        $('.proses_category_lainnya').hide();
        $('#proses_category').on('change', function () {
            if(this.value == "Lainnya"){
                swal({
                    title: 'Warning',
                    text: 'Proses Category Lainnya mohon untuk diinput manual',
                    icon: 'warning'
                });
                $('.proses_category_lainnya').show();
            } else {
                $('.proses_category_lainnya').hide();
            }
        });
    });
</script>

@endsection