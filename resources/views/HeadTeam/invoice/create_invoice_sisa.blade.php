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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Buat Invoice</h4>
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
                            <h5 class="panel-title">Buat Invoice Sisa</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="panel-body">
                            <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.executeprocessinvoice_sisa') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                <fieldset class="content-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('project_number') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Project Number: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="project_number" class="form-control input-xs" value="{{ $datanya['data_rl']->project_number}}" readonly>
                                                @error('project_number')
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('proses_category') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4"> Proses Category: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <select name="proses_category" id="proses_category" class="form-control input-xs @error('proses_category') is-invalid @enderror" required>
                                                        <option value="">---</option>
                                                        @foreach($datanya['proses_category'] as $row)
                                                        <option value="{{$row->proses_categories}}">{{$row->proses_categories}}</option>
                                                        @endforeach

                                                        @error('proses_category')
                                                            <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group proses_category_lainnya @error('proses_category_lainnya') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Proses Category Lainnya</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="proses_category_lainnya" class="form-control border-warning border-md input-xs" placeholder="Please Input proses category lainnya..">
                                                </div>
                                            </div>
                                            <div class="form-group @error('proses_persen') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4"> Proses Persent: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <select name="proses_persen" id="proses_persen" class="form-control input-xs @error('proses_persen') is-invalid @enderror" required>
                                                        <option value="">---</option>
                                                        @foreach($datanya['persen'] as $row)
                                                        <option value="{{$row->proses_persen}}">{{$row->proses_persen}}</option>
                                                        @endforeach

                                                        @error('proses_persen')
                                                            <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group @error('due_date') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Due Date: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="date" name="due_date" class="form-control input-xs" value="" required>
                                                    @error('due_date')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('keterangan') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Keterangan: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <textarea rows="2" name="keterangan" class="form-control" placeholder="Enter keterangan...">{{ old('keterangan') }}</textarea>
                                                    @error('keterangan')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-6">
                                            <div class="form-group @error('po_number') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">PO Number: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="po_number" id="po_number" class="form-control input-xs" required value="{{ $datanya['data_rl']->po_number}}" readonly>
                                                    @error('po_number')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('nominal_pembayaran') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Nominal Pembayaran: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="nominal_pembayaran" id="format_nominal_pembayaran" class="form-control input-xs" required value="{{ number_format($datanya['data_rl']->po_nominal, 0, '.', '.')}}" readonly>
                                                    @error('nominal_pembayaran')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('nama_customer') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Nama Customer: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="nama_customer" id="nama_customer" class="form-control input-xs" required value="{{ $datanya['data_rl']->nama_customer}}" readonly>
                                                    @error('nama_customer')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" id="address_customer" name="address_customer" value="{{ $datanya['data_cust']->address_customer}}">
                                            <input type="hidden" id="address_customer1" name="address_customer1" value="{{ $datanya['data_cust']->address_customer1}}">
                                            <input type="hidden" id="deskripsi_customer" name="deskripsi_customer" value="{{ $datanya['data_cust']->deskripsi_customer}}">
                                            
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <div class="text-right mb-3">
                                    <div class="loader">
                                        <img src="{{ asset('assets/spinner/spinner.gif') }}" style="width: 65px; height: 60px;">
                                    </div>
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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });
</script>
@endsection