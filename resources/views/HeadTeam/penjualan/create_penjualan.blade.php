<!-- TITLE  -->
@section('title', 'Buat Penjualanan Baru')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<style type="text/css">
    .loader{
        display: none;
    }
</style>

<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main Content -->
        <div class="content-wrapper">

            <!-- Tab content -->
            <div class="tab-content">

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Buat Penjualanan Baru<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <h6 class="alert-heading text-semibold">NOTE:</h6>
                            - Form ini akan generate atau membuat <b>Project Number</b> baru secara automatis.<br>
                            - Form input Penjualan ini akan masuk ke data <b>Penjualan</b> dan <b>Rugi Laba</b>.<br>
                            - Untuk tanda (<span class="text-danger">*</span>) wajib diisi.<br>
                        </div> 

                        <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.prosesPenjualan') }}" method="POST">
                            <fieldset class="content-group">
                                <legend class="text-bold">Purchase Order</legend>
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group @error('customer_name') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-4">Nama Customer: <span class="text-danger">*</span> </label>
                                            <div class="col-lg-8">
                                                <select class="form-control input-xs @error('customer_name') is-invalid @enderror" name="customer_name" id="customer_name" data-live-search="true"></select>
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
                                                <textarea rows="2" name="alamat_customer" id="alamat_customer" class="form-control" required placeholder="Alamat Customer automatis input ketika memilih project number." readonly>{{ old('alamat_customer') }}</textarea>
                                                @error('alamat_customer')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('po_number') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-4">PO Nomor: <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" name="po_number" class="form-control input-xs" value="{{ old('po_number') }}" required placeholder="Input po number...">
                                                @error('po_number')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('po_date') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-4">PO Tanggal: <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="date" name="po_date" class="form-control input-xs" value="{{ old('po_date') }}" required>
                                                @error('po_date')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('category') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-4">PO Kategori: <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <select name="category" class="form-control input-xs @error('category') is-invalid @enderror" required>
                                                    <option value="">---</option>
                                                    @foreach($datanya['category'] as $row)
                                                    <option value="{{ $row->category }}">{{ $row->category }}</option>
                                                    @endforeach
                                                    @error('category')
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group @error('nominal_po') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-4">PO Nominal: <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text" id="nominal_po" name="nominal_po" class="form-control input-xs" value="{{ old('nominal_po') }}" required placeholder="Enter Nominal tanpa coma atau pemisah, contoh: 1000000">
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
                                            <label class="control-label col-lg-4">Deskripsi: <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <textarea rows="2" name="deskripsi" class="form-control" placeholder="Enter deskripsi">{{ old('deskripsi') }}</textarea>
                                                @error('deskripsi')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group @error('lokasi') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-4">Lokasi: <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <textarea rows="2" name="lokasi" class="form-control" placeholder="Enter lokasi...">{{ old('lokasi') }}</textarea>
                                                @error('lokasi')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group @error('info_payment') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-4">Info pembayaran: <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <textarea rows="2" name="info_payment" class="form-control" placeholder="Enter info pembayaran...">{{ old('info_payment') }}</textarea>
                                                @error('info_payment')
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
                                <button type="submit" class="btn btn-primary" id="btn-submit">Submit <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- /main Content -->

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
@endif

<!-- {{-- SELECT Project Number --}} -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $('#customer_name').select2({
        placeholder: 'PILIH CUSTOMER NAME',
        ajax: {
            url: '{{ route("HeadTeam.get_customer_name") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    console.log(item.nama_customer);
                    return {
                        text: item.nama_customer,
                        id: item.nama_customer
                    }
                })
            };
            },
            cache: true
        }
    });

    $(document).ready(function(){

        $("#customer_name").click(function(){
            let keyword = '';
            $("#customer_name").keyup(function() {
                keyword = this.value;
                console.log(keyword);
            });

            $.ajax({
                url: "{{ route('HeadTeam.get_customer_name') }}",
                cache: false,
                success: function(data){
                    $("#customer_name").select2();
                    $("#customer_name").append(data);
                    // console.log(data);
                    
                  }
            });
        });

        $('#customer_name').on('change', function () {
  		    if(!this.value == ""){

                console.log(this.value);

                $.ajax({
                    url: "{{ route('HeadTeam.get_detail_customer_name') }}",
                    data: {
                        id: this.value
                    },
                    success: function( data ) {
                        console.log(data);
                        var full_address = data.address_customer +" "+data.address_customer1+" "+data.deskripsi_customer;
                        $("#alamat_customer").val(full_address);
                        
                    }
                });
            }
	    });

    });
</script>

<!-- Fortmat input nominal  -->
<script>
    
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
</script>

@endsection