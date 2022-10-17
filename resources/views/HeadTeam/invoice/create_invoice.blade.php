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
                            <h5 class="panel-title">Buat Invoice</h5> <button class="btn btn-info btn-sm btn-test">Tester Alert</button>
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
                                - Jika ingin membuat invoice manual silahkan klik link disamping. <a href="{{ route('HeadTeam.buatinvoicemanual') }}" >Click Here</a><br>
                            </div>
                            <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.executeprocessinvoice') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                <fieldset class="content-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('project_number') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Project Number: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <select class="form-control input-xs @error('project_number') is-invalid @enderror" name="project_number" id="project_number" data-live-search="true"></select>
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
                                                    <input type="text" name="po_number" id="po_number" class="form-control input-xs" required placeholder="Nominal pembayaran automatis input ketika memilih project number." readonly>
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
                                                    <input type="text" name="nominal_pembayaran" id="format_nominal_pembayaran" class="form-control input-xs" required placeholder="Nominal pembayaran automatis input ketika memilih project number." readonly>
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
                                                    <input type="text" name="nama_customer" id="nama_customer" class="form-control input-xs" value="" required placeholder="Nama Customer automatis input ketika memilih project number." readonly>
                                                    @error('nama_customer')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" id="address_customer" name="address_customer">
                                            <input type="hidden" id="address_customer1" name="address_customer1">
                                            <input type="hidden" id="deskripsi_customer" name="deskripsi_customer">
                                            
                                            <div class="form-group @error('have_discount') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4"> Have Discount: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <select name="have_discount" id="have_discount" class="form-control input-xs @error('have_discount') is-invalid @enderror" required>
                                                        <option value="no" selected>No</option>
                                                        <option value="yes">Yes</option>
                                                        @error('proses_category')
                                                            <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group nominal_discount @error('nominal_discount') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Nominal Discount:</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="nominal_discount" class="form-control border-warning border-md input-xs" placeholder="Please Input Nominal discount nya...">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </fieldset>

                                <legend class="text-bold">
                                    Tambahkan Barang  <input type="text" id="inputNominal" value="" name="inputNominal" disabled>
                                    <!-- Source (https://www.kursuswebsite.org/membuat-multiple-input-field-dengan-jquery/) -->
                                </legend>
                                <a href="javascript:void(0)" class="btn btn-xs bg-purple-400 addMore" style="margin-bottom:15px;"><i class="glyphicon glyphicon-plus"></i> Tambah Barang</a>

                                <fieldset class="content-group">
                                    <div class="row form-group fieldGroup">
                                        <div class="col-md-4">
                                            <label>Deskripsi: <span class="text-danger">*</span></label>
                                            <textarea rows="2" name="deskripsi[]" class="form-control input-xs" placeholder="Enter Deskripsi" required>{{ old('deskripsi') }}</textarea>
                                        </div>
                                        <div class="col-md-1">
                                            <label>Satuan: <span class="text-danger">*</span></label>
                                            <input type="text" id="satuan" name="satuan[]" class="form-control input-xs" value="{{ old('satuan') }}" required placeholder="Enter satuan barang">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Quantity: <span class="text-danger">*</span></label>
                                            <input type="number" id="quantity" name="quantity[]" class="form-control input-xs" value="{{ old('quantity') }}" required placeholder="Enter Quantity">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Harga Unit: <span class="text-danger">*</span></label>
                                            <input type="text" id="harga_unit" name="harga_unit[]" class="form-control input-xs" value="{{ old('harga_unit') }}" required placeholder="Enter harga unit tanpa coma atau pemisah, contoh: 1000000">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Total Harga: <span class="text-danger">*</span></label>
                                            <input type="text" id="total_harga" name="total_harga[]" class="form-control input-xs" value="{{ old('total_harga') }}" required placeholder="Enter Total Harga tanpa coma atau pemisah, contoh: 1000000">
                                        </div>
                                    </div>

                                    <div class="row form-group fieldGroupCopy">
                                        <div class="col-md-4">
                                            <label>Deskripsi: <span class="text-danger">*</span></label>
                                            <textarea rows="2" name="deskripsi[]" class="form-control input-xs" placeholder="Enter Deskripsi">{{ old('deskripsi') }}</textarea>
                                        </div>
                                        <div class="col-md-1">
                                            <label>Satuan: <span class="text-danger">*</span></label>
                                            <input type="text" id="satuan" name="satuan[]" class="form-control input-xs" value="{{ old('satuan') }}" placeholder="Enter satuan barang">
                                            
                                        </div>

                                        <div class="col-md-2">
                                            <label>Quantity: <span class="text-danger">*</span></label>
                                            <input type="number" id="quantity" name="quantity[]" class="form-control input-xs" value="{{ old('quantity') }}" placeholder="Enter Quantity">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Harga Unit: <span class="text-danger">*</span></label>
                                            <input type="text" id="harga_unit" name="harga_unit[]" class="form-control input-xs" value="{{ old('harga_unit') }}" placeholder="Enter harga unit tanpa coma atau pemisah, contoh: 1000000">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Total Harga: <span class="text-danger">*</span></label>
                                            <input type="text" id="total_harga" name="total_harga[]" class="form-control input-xs" value="{{ old('total_harga') }}" placeholder="Enter Total Harga tanpa coma atau pemisah, contoh: 1000000">
                                        </div>
                                        <div class="col-md-1">
                                            <br>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm remove " style="margin-left:5px;margin-top:3px;"><i class="glyphicon glyphicon-trash"></i></a>
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

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

        
        
        // var values = "0"; 
        // $("input[name='total_harga[]']").on('change', function(){ 
        //     var nilai = $(this).val();

        //     var values = values + nilai;
        //     alert(nilai);
        //     $('#inputNominal').html(formatRupiah(values));
        // }).get(values);
        
    });
</script>

<script>
    $('.btn-test').on('click', function (){
        // alert("hellow");
        swal({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
        });
    });
</script>

<!-- {{-- SELECT Project Number --}} -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    // Format input nominal
    function formatRupiah(angka, prefix){

        var number_string = angka.toString().replace(/[^,\d]/g, ''),
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

    $('#project_number').select2({
        placeholder: 'PILIH PROJECT NUMBER',
        ajax: {
            url: '{{ route("HeadTeam.get_projectNumber") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    console.log(item.project_number);
                    return {
                        text: item.project_number,
                        id: item.project_number
                    }
                })
            };
            },
            cache: true
        }
    });

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

        $('.nominal_discount').hide();
        $('#have_discount').on('change', function () {
            if(this.value == "yes"){
                $('.nominal_discount').show();
            } else {
                $('.nominal_discount').hide();
            }
        });

        $("input[name='total_harga[]']").on("blur", function(){
            var sum=0;
            $("input[name='total_harga[]']").each(function(){
                if($(this).val() !== "")
                sum += parseInt($(this).val(), 10);   
            });

            $('#inputNominal').val(formatRupiah(sum));
        });

        // $("#total_harga").blur(function () {
            
        //     var sum = 0;
        //     $("#total_harga").each( function (){
        //         sum += Number($(this).val());
        //     });
        //     console.log(sum);
        //     $('#inputNominal').html(formatRupiah(sum));
        // });


        $("#project_number").click(function(){
            let keyword = '';
            $("#project_number").keyup(function() {
                keyword = this.value;
                console.log(keyword);
            });

            $.ajax({
                url: "{{ route('HeadTeam.get_projectNumber') }}",
                cache: false,
                success: function(data){
                    $("#project_number").select2();
                    $("#project_number").append(data);
                }
            });
        });

        $('#project_number').on('change', function () {
  		    if(!this.value == ""){

                console.log(this.value);

                $.ajax({
                    url: "{{ route('HeadTeam.get_data_detail_project_number') }}",
                    data: {
                        id: this.value
                    },
                    success: function( data ) {
                        po_nominal_db = data.po_nominal;
                        console.log(po_nominal_db);
                        po_nominal = formatRupiah(po_nominal_db);
                        $("#po_number").val(data.po_number);
                        $("#format_nominal_pembayaran").val(po_nominal);
                        $("#nama_customer").val(data.nama_customer);
                        
                        $("#address_customer").val(data.address_customer);
                        $("#address_customer1").val(data.address_customer1);
                        $("#deskripsi_customer").val(data.deskripsi_customer);
                        
                    }
                });
            }
	    });

    });
</script>

 <!-- Multiple Input -->
<script>
	$(document).ready(function(){
        // membatasi jumlah inputan
        var maxGroup = 10;
    
        //melakukan proses multiple input 
        $(".addMore").click(function(){
            if($('body').find('.fieldGroup').length < maxGroup){
                var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
                $('body').find('.fieldGroup:last').after(fieldHTML);
            }else{
                alert('Maximum input barang '+maxGroup+' saja');
            }
        });
    
        //remove fields group
        $("body").on("click",".remove",function(){ 
            $(this).parents(".fieldGroup").remove();
            alert("button has been click");
        });
    });
</script>
@endsection