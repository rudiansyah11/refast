<!-- TITLE  -->
@section('title', 'Penjualanan Detail Project ')

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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Penjualanan - {{ $datanya['data_pn']->project_number }} </h4>
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

            <div class="row">
                <div class="col-lg-7">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Purchase Order</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="panel-body">
                            <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.prosesUpdatePenjualan') }}" method="POST">
                                <fieldset class="content-group">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                    <input type="hidden" value="{{ $datanya['data_pn']->project_number }}" name="project_number">
        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('customer_name') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Customer Name: </label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="customer_name" class="form-control input-xs" value="{{ $datanya['data_pn']->nama_customer }}" required placeholder="Input customer name...">
                                                    @error('customer_name')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('alamat_customer') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Alamat Customer:</label>
                                                <div class="col-lg-8">
                                                    <textarea rows="2" name="alamat_customer" id="alamat_customer" class="form-control" required placeholder="Alamat Customer automatis input ketika memilih project number.">{{ $datanya['data_pn']->alamat_customer }}</textarea>
                                                    @error('alamat_customer')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('po_number') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">PO Number:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="po_number" class="form-control input-xs" value="{{ $datanya['data_pn']->po_number }}" required placeholder="Input po number...">
                                                    @error('po_number')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('po_date') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">PO Date:</label>
                                                <div class="col-lg-8">
                                                    <input type="date" name="po_date" class="form-control input-xs" value="{{ $datanya['data_pn']->po_date }}" required>
                                                    @error('po_date')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('category') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">PO Category:</label>
                                                <div class="col-lg-8">
                                                    <select name="category" class="form-control input-xs @error('category') is-invalid @enderror" required>
                                                        @foreach($datanya['category'] as $row)
                                                            @if($row->category == $datanya['data_pn']->po_category)
                                                            <option value="{{ $row->category }}" selected>{{ $row->category }}</option>
                                                            @else 
                                                            <option value="{{ $row->category }}">{{ $row->category }}</option>
                                                            @endif
                                                        @endforeach 
        
                                                        @error('category')
                                                            <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group @error('nominal_po') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">PO Nominal:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="nominal_po" id="nominal_po" class="form-control input-xs" value="{{ number_format($datanya['data_pn']->po_nominal, 0, '.', '.') }}" required placeholder="Enter Nominal tanpa coma atau pemisah, contoh: 1000000">
                                                    @error('nominal_po')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6">
                                            
                                            <div class="form-group @error('deskripsi') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Deskripsi:</label>
                                                <div class="col-lg-8">
                                                    <textarea rows="2" name="deskripsi" class="form-control" placeholder="Enter deskripsi">{{ $datanya['data_pn']->deskripsi }}</textarea>
                                                    @error('deskripsi')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('lokasi') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Lokasi:</label>
                                                <div class="col-lg-8">
                                                    <textarea rows="2" name="lokasi" class="form-control" placeholder="Enter lokasi...">{{ $datanya['data_pn']->lokasi }}</textarea>
                                                    @error('lokasi')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('info_pembayaran') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Info Pembayaran:</label>
                                                <div class="col-lg-8">
                                                    <textarea rows="2" name="info_pembayaran" class="form-control" placeholder="Enter info pembayaran...">{{ $datanya['data_pn']->info_pembayaran }}</textarea>
                                                    @error('info_pembayaran')
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
                                    <a href="{{route('HeadTeam.penjualan')}}" class="btn btn-danger" >Kembali <i class="icon-backspace2 position-right"></i></a>
                                    <button type="submit" class="btn btn-success" id="btn-submit">Update <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">

                    <div class="row col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Invoice</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
            
                            <div class="panel-body"> 
                                <div class="row table-responsive">
                                    <div class="col-md-12">
                                        <table class="table table-striped" style="margin-top:10px;">
                                            <thead class="bg-success">
                                                <tr>
                                                    <th class="text-center">No. INVOICE</th>
                                                    <th class="text-center">Amount</th>
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
                                                        <td>{{ number_format($row->nominal_pembayaran, 0, '.', '.') }}</td>
                                                        <td><a href="{{ route('HeadTeam.editinvoice', $row->passing_id);}}" class="btn btn-rounded btn-xs btn-success">Lihat</a></td>
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
                    <div class="row col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">File Attachment:</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row col-md-12">
                                    <form action="{{route('HeadTeam.executefilepo')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                        <input type="hidden" value="{{ $datanya['data_pn']->project_number }}" name="project_number">
                                        <div class="form-group">
                                            <label for="filenya">Pilih File untuk dijadikan Attachment Purchase Order</label>
                                            <input type="file" class="form-control-file" name="filenya" id="filenya" accept="application/pdf" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-block btn-xs btn-primary">UPLOAD</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="row col-md-12 table-responsive">
                                    <table class="table table-sm table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Name File</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datanya['po_file'] as $row)
                                                <tr>
                                                    <td>
                                                        {{ $row->file_name }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ asset('storage/uploads/filepo/'.$row->file_name ) }}" class="btn btn-rounded btn-xs btn-success" target="_blank">Lihat</a>
                                                    
                                                        <!-- <a href="{{route('HeadTeam.showAttachment', $row->id)}}" class="btn btn-rounded btn-xs btn-success" target="_blank">Lihat</a> -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

        var nominal_po = document.getElementById('nominal_po');
        nominal_po.addEventListener('keyup', function(e) {
            nominal_po.value = formatRupiah(this.value);
        });

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