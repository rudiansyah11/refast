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
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Financial</span> - Invoice - Show or Edit Invoice <b><u> {{ $datanya['data_invoice']->no_invoice }} </u></b> </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="{{route('HeadTeam.showPDF',$datanya['data_invoice']->passing_id )}}" class="btn btn-link btn-float has-text">
                    <i class="icon-file-pdf text-primary"></i> <span>Export PDF</span>
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
                <div class="col-lg-12">
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
                            <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.prosesupdateinvoice') }}" method="POST">
                                @csrf 
                                <input type="hidden" value="{{$datanya['data_invoice']->passing_id}}" name="passing_id">
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                <fieldset class="content-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('no_invoice') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">No INVOICE: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="no_invoice" class="form-control input-xs" readonly value="{{$datanya['data_invoice']->no_invoice}}" required>
                                                @error('no_invoice')
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('project_number') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Project Number: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="hidden" name="project_number_old" value="{{$datanya['data_invoice']->project_number}}">
                                                <select class="form-control input-xs @error('project_number') is-invalid @enderror" name="project_number" id="project_number" data-live-search="true">
                                                    <option value="{{$datanya['data_invoice']->project_number}}" selected>{{$datanya['data_invoice']->project_number}}</option>
                                                </select>
                                                @error('project_number')
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('proses_category') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4"> Proses Category: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <select name="proses_category" id="proses_category" class="form-control input-xs @error('proses_category') is-invalid @enderror" required>
                                                        @foreach($datanya['proses_category'] as $row)
                                                            @if( $row->proses_categories == $datanya['data_invoice']->proses_category)
                                                            <option value="{{$datanya['data_invoice']->proses_category}}" selected>{{$datanya['data_invoice']->proses_category}}</option>
                                                            @else
                                                            <option value="{{$row->proses_categories}}">{{$row->proses_categories}}</option>
                                                            @endif
                                                        @endforeach

                                                        @error('proses_category')
                                                            <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group @error('proses_persen') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4"> Proses Persent: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <select name="proses_persen" id="proses_persen" class="form-control input-xs @error('proses_persen') is-invalid @enderror" required>
                                                        @foreach($datanya['persen'] as $row)
                                                            @if($row->proses_persen == $datanya['data_invoice']->proses_percent)
                                                            <option value="{{$row->proses_persen}}" selected>{{$row->proses_persen}}</option>
                                                            @else 
                                                                <option value="{{$row->proses_persen}}">{{$row->proses_persen}}</option>
                                                            @endif
                                                        @endforeach

                                                        @error('proses_persen')
                                                            <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group @error('subtotal') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Amount: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="subtotal" class="form-control input-xs" value="{{ number_format($datanya['data_invoice']->subtotal, 0, '.', '.') }}" readonly>
                                                    @error('subtotal')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('due_date') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Due Date: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <input type="date" name="due_date" class="form-control input-xs" value="{{$datanya['data_invoice']->due_date}}" required>
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
                                                    <textarea rows="2" name="keterangan" class="form-control" placeholder="Enter keterangan...">{{$datanya['data_invoice']->keterangan}}</textarea>
                                                    @error('keterangan')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('status_invoice') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Status Invoice: <span class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <select name="status_invoice" class="form-control input-xs @error('status_invoice') is-invalid @enderror" required>
                                                        @if($datanya['data_invoice']->status_invoice == "New")
                                                        <option value="New" selected>Baru Dibuat</option>
                                                        <option value="Sent">Terkirim</option>
                                                        <option value="paid_off">Terbayar/Lunas</option>
                                                        <option value="cancel">Cancel</option>
                                                        @elseif($datanya['data_invoice']->status_invoice == "Sent")
                                                        <option value="New">Baru Dibuat</option>
                                                        <option value="Sent" selected>Terkirim</option>
                                                        <option value="paid_off">Terbayar/Lunas</option>
                                                        <option value="cancel">Cancel</option>
                                                        @elseif($datanya['data_invoice']->status_invoice == "paid_off")
                                                        <option value="New">Baru Dibuat</option>
                                                        <option value="Sent">Terkirim</option>
                                                        <option value="paid_off" selected>Terbayar/Lunas</option>
                                                        <option value="cancel">Cancel</option>
                                                        @else
                                                        <option value="New">Baru Dibuat</option>
                                                        <option value="Sent">Terkirim</option>
                                                        <option value="paid_off">Terbayar/Lunas</option>
                                                        <option value="cancel" selected>Cancel</option>
                                                        @endif
                                                    </select>
                                                    @error('status_invoice')
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group @error('aktual_pembayaran') has-warning has-feedback @enderror">
                                                <label class="control-label col-lg-4">Aktual Pembayaran: </label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="aktual_pembayaran" id="aktual_pembayaran" class="form-control input-xs" value="{{ number_format($datanya['data_invoice']->aktual_pembayaran, 0, '.', '.') }}" required>
                                                    @error('aktual_pembayaran')
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
                                                    <input type="text" name="po_number" id="po_number" class="form-control input-xs" value="{{$datanya['data_invoice']->po_number}}" readonly>
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
                                                    <input type="text" name="nominal_pembayaran" id="format_nominal_pembayaran" class="form-control input-xs" value="{{ number_format($datanya['data_invoice']->nominal_pembayaran, 0, '.', '.') }}" readonly>
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
                                                    <input type="text" name="nama_customer" id="nama_customer" class="form-control input-xs" value="{{$datanya['data_invoice']->nama_customer}}" readonly>
                                                    @error('nama_customer')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" id="address_customer" name="address_customer" value="{{$datanya['data_invoice']->address_customer}}">
                                            <input type="hidden" id="address_customer1" name="address_customer1" value="{{$datanya['data_invoice']->address_customer1}}">
                                            <input type="hidden" id="deskripsi_customer" name="deskripsi_customer" value="{{$datanya['data_invoice']->deskripsi_customer}}">
                                            
                                        </div>
        
                                    </div>
                                </fieldset>
                                
                                <div class="text-right mb-3">
                                    <div class="loader">
                                        <img src="{{ asset('assets/spinner/spinner.gif') }}" style="width: 65px; height: 60px;">
                                    </div>
                                    <a href="{{route('HeadTeam.invoice')}}" class="btn btn-danger" >Kembali <i class="icon-backspace2 position-right"></i></a>
                                    @if($datanya['data_invoice']->status_invoice == "cancel")
                                        <button type="submit" class="btn btn-success" id="btn-submit" disabled>Update <i class="icon-arrow-right14 position-right"></i></button>
                                    @else
                                        <button type="submit" class="btn btn-success" id="btn-submit">Update <i class="icon-arrow-right14 position-right"></i></button>
                                    @endif
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">List Barang</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered table-sm text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Harga Unit</th>
                                        <th class="text-center">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datanya['data_barang'] as $row)
                                    <tr>
                                        <td>{{ $row->deskripsi}}</td>
                                        <td>{{ $row->satuannya}}</td>
                                        <td>{{ $row->quantity}}</td>
                                        <td>{{ number_format($row->harga_unit, 0, '.', '.') }}</td>
                                        <td>{{ number_format($row->total_harga, 0, '.', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align:end;">Subtotal:</td>
                                        <td>IDR {{ number_format($datanya['subtotal'], 0, '.', '.') }}</td>
                                    </tr>
                                    @if($datanya['data_invoice']->have_discount == "yes")
                                    <tr>
                                        <td colspan="4" style="text-align:end;">Discount :</td>
                                        <td>IDR {{ number_format($datanya['data_invoice']->nominal_discount, 0, '.', '.') }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4" style="text-align:end;">{{ $datanya['data_invoice']->proses_category }} {{ $datanya['data_invoice']->proses_percent }}% :</td>
                                        <td>IDR {{ number_format($datanya['data_invoice']->subtotal, 0, '.', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:end;">PPN 11%:</td>
                                        <td>IDR {{ number_format($datanya['data_invoice']->nominal_ppn11, 0, '.', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:end;">Total Payment:</td>
                                        <td>IDR {{ number_format($datanya['data_invoice']->nominal_pembayaran_with_ppn11, 0, '.', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
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
                                <form action="{{route('HeadTeam.executefileinvoice')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                    <input type="hidden" value="{{ $datanya['data_invoice']->no_invoice }}" name="no_invoice">
                                    <input type="hidden" value="{{ $datanya['data_invoice']->passing_id }}" name="passing_id">
                                    <div class="form-group">
                                        <label for="filenya">Pilih File untuk dijadikan Attachment Invoice</label>
                                        <input type="file" class="file-input-pdf" name="filenya">
                                        <span class="help-block">Allow only specific file extensions. In this example only <code>PDF</code> extensions are allowed.</span>
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
                                        @foreach($datanya['invoice_file'] as $row)
                                            <tr>
                                                <td>
                                                    {{ $row->file_name }}
                                                </td>
                                                <td>
                                                    <a href="{{ asset('storage/uploads/fileinvoice/'.$row->file_name ) }}" class="btn btn-rounded btn-xs btn-success" target="_blank">Lihat</a>
                                                
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

<!-- {{-- SELECT Project Number --}} -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

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

        var aktual_pembayaran = document.getElementById('aktual_pembayaran');
        aktual_pembayaran.addEventListener('keyup', function(e) {
            aktual_pembayaran.value = formatRupiah(this.value);
        });

        // Format input nominal
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

        // Modal template Form UPLOAD PDF
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header">\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
            fullscreen: 'btn btn-default btn-icon btn-xs',
            borderless: 'btn btn-default btn-icon btn-xs',
            close: 'btn btn-default btn-icon btn-xs'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross3"></i>'
        };

        // FILE UPLOAD LOADER
        $(".file-input-pdf").fileinput({
            browseLabel: 'Browse',
            browseClass: 'btn btn-primary',
            uploadClass: 'btn btn-default',
            browseIcon: '<i class="icon-file-plus"></i>',
            uploadIcon: '<i class="icon-file-upload2"></i>',
            removeIcon: '<i class="icon-cross3"></i>',
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            maxFilesNum: 10,
            allowedFileExtensions: ["pdf", "PDF"],
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons
        });


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
                        console.log(data);

                        po_nominal_db = data.po_nominal;
                        // console.log(po_nominal_db);
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

@endsection