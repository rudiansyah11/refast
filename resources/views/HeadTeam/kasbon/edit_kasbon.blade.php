<!-- TITLE  -->
@section('title', 'Edit Kasbon')

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

                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Edit Kasbon<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                                    - Untuk tanda (<span class="text-danger">*</span>) wajib diisi.<br>
                                </div> 

                                <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.updateprocesskasbon') }}" method="POST" >
                                    <fieldset class="content-group">
                                        <legend class="text-bold">{{ $datanya['validasi_data']->no_kasbon }}</legend>
                                        @csrf
                                        <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                        <input type="hidden" value="{{ $datanya['validasi_data']->passing_id }}" name="passing_id">
                                        <input type="hidden" value="{{ $datanya['validasi_data']->no_kasbon }}" name="no_kasbon">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group @error('name_pic') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Nama PIC: <span class="text-danger">*</span> </label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control input-xs @error('name_pic') is-invalid @enderror" name="name_pic" id="name_pic" required data-live-search="true">
                                                            <option value="{{ $datanya['validasi_data']->pic }}">{{ $datanya['validasi_data']->pic }}</option>
                                                        </select>
                                                        @error('name_pic')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group @error('total_amount') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Total Amount: <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="total_amount" id="total_amount" class="form-control input-xs" value="{{ number_format($datanya['validasi_data']->total_amount, 0, '.', '.') }}" required placeholder="Input Total Amount">
                                                        @error('total_amount')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group @error('payment') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Payment: <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select name="payment" class="form-control input-xs @error('payment') is-invalid @enderror" required>
                                                            @if($datanya['validasi_data']->payment == "Cash")
                                                                <option value="Cash" selected>Cash</option>
                                                                <option value="Transfer">Transfer</option>
                                                            @else 
                                                                <option value="Cash">Cash</option>
                                                                <option value="Transfer" selected>Transfer</option>
                                                            @endif

                                                            @error('payment')
                                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group @error('date_transfer') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Tanggal Transfer: </label>
                                                    <div class="col-lg-8">
                                                        <input type="date" name="date_transfer" class="form-control input-xs" value="{{ $datanya['validasi_data']->tgl_transfer }}">
                                                        @error('date_transfer')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group @error('statusnya') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">statusnya: <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <select name="statusnya" class="form-control input-xs @error('statusnya') is-invalid @enderror" required>
                                                            @if($datanya['validasi_data']->statusnya == "Open")
                                                                <option value="Open" selected>Open</option>
                                                                <option value="Close">Close</option>
                                                            @else 
                                                                <option value="Open">Open</option>
                                                                <option value="Close" selected>Close</option>
                                                            @endif

                                                            @error('statusnya')
                                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                            @enderror
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group @error('over_or_under') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Over or Under: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="over_or_under" class="form-control input-xs" value="{{ $datanya['validasi_data']->over_under }}" readonly>
                                                        @error('over_or_under')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group @error('resultnya') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Nominal Result: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="resultnya" class="form-control input-xs" value="{{ number_format($datanya['validasi_data']->resultnya, 0, '.', '.')  }}" readonly>
                                                        @error('resultnya')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group @error('tgl_realisasi') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Tanggal Realisasi: </label>
                                                    <div class="col-lg-8">
                                                        <input type="date" name="tgl_realisasi" class="form-control input-xs" value="{{ $datanya['validasi_data']->tgl_realisasi }}" readonly>
                                                        @error('tgl_realisasi')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group @error('no_realisasi') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">No Realisasi: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="no_realisasi" class="form-control input-xs" value="{{ $datanya['validasi_data']->no_realisasi }}" readonly>
                                                        @error('no_realisasi')
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
                                        <a href="{{route('HeadTeam.kasbon')}}" class="btn btn-danger" >Kembali <i class="icon-backspace2 position-right"></i></a>
                                        <button type="submit" class="btn btn-primary" id="btn-submit">Update <i class="icon-arrow-right14 position-right"></i></button>

                                        @if( $datanya['validasi_data']->statusnya == "Close")
                                            @if( $datanya['validasi_data']->no_realisasi != "-" )
                                                <a href="{{ route('HeadTeam.show_realisasi', $datanya['validasi_data']->passing_id) }}" class="btn btn-success">Lihat Realisasi <i class="icon-eye position-right"></i></a>
                                            @else
                                                <a href="{{ route('HeadTeam.create_realisasi', $datanya['validasi_data']->passing_id) }}" class="btn btn-warning" >Buat Realisasi <i class="icon-cart-add2 position-right"></i></a>
                                            @endif
                                        @endif
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 table-responsive">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">File Lampiran Kasbon<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.uploadfilekasbon') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                    <input type="hidden" value="{{ $datanya['validasi_data']->passing_id }}" name="passing_id">
                                    <input type="hidden" value="{{ $datanya['validasi_data']->no_kasbon }}" name="no_kasbon">

                                    <div class="form-group">
                                        <label for="filenya">Pilih File untuk dijadikan Attachment Kasbon terkait.</label>
                                        <input type="file" class="form-control-file" name="filenya[]" id="filenya" accept="image/*" placeholder="Choose files" multiple>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary"> Tambahkan File Lampiran</button> <br><br>
                                </form>

                                <table class="table table-sm table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">File Name</th>
                                            <th class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if( $datanya['file_kasbon']->isEmpty() )
                                            <tr>
                                                <td colspan="2"><h6 class="text-muted">Gk ada file lampiran!</h6></td>
                                            </tr>
                                        @else
                                            @foreach($datanya['file_kasbon'] as $row)
                                            <tr>
                                                <td>{{ $row->file_name }}</td>
                                                <td>
                                                    <a href="{{ asset('storage/uploads/filekasbon/'.$row->file_name ) }}" class="btn btn-rounded btn-xs btn-success" download>Download</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Deskripsi Kasbon<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                    <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#show_tambah_deskripsi">Tambah deskripsi kasbon</a> <br><br>
                                        <table class="table table-striped table-bordered table-sm table-responsive">
                                            <thead style="background-color:#28343a;color: #FFF">
                                                <tr>
                                                    <th class="text-center">Deskripsi</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @if( $datanya['data_deskripsi']->isEmpty() )
                                                    <tr>
                                                        <td colspan="3"><h6 class="text-muted">Data belum ada!</h6></td>
                                                    </tr>
                                                @else
                                                    @foreach($datanya['data_deskripsi'] as $row)
                                                    <tr>
                                                        <td>{{ $row->deskripsi_kasbon }}</td>
                                                        <td>{{ number_format($row->amount, 0, '.', '.') }}</td>
                                                        <td>{{ $row->keterangan }}</td>

                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="1">Grand Total: </td>
                                                        <?php
                                                            if($datanya['validasi_data']->over_under == "Over") {
                                                                $color = "#bb2124";
                                                                $hasilnya = "Kurang";
                                                            } else if($datanya['validasi_data']->over_under == "Under"){
                                                                $color = "#22bb33";
                                                                $hasilnya = "Kelebihan";
                                                            } else {
                                                                $color = "#5bc0de";
                                                                $hasilnya = "Pas - ";
                                                            }
                                                        ?>
                                                        <td colspan="1" style="background-color: <?= $color;?>; color:white;">
                                                            Rp. {{ number_format($datanya['total_nominal_desc'], 0, '.', '.') }}
                                                        </td>
                                                        <td colspan="1" style="background-color: <?= $color;?>; color:white;">
                                                            <?= $hasilnya; ?> Rp. {{ number_format($datanya['validasi_data']->resultnya, 0, '.', '.') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /main Content -->

        <!-- Modal tambah Deskripsi -->
        <div id="show_tambah_deskripsi" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Tambahkan Deskripsi</h5>
                    </div>

                    <form method="POST" action="{{route('HeadTeam.executeprocesskasbondeskripsi_fromedit')}}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                <input type="hidden" value="{{ $datanya['validasi_data']->passing_id }}" name="passing_id">
                                <input type="hidden" value="{{ $datanya['validasi_data']->no_kasbon }}" name="no_kasbon">

                                <div class="form-group @error('deskripsi_kasbon') has-warning has-feedback @enderror">
                                    <label class="control-label col-lg-4">Deskripsi Kasbon: <span class="text-danger">*</span> </label>
                                    <div class="col-lg-8">
                                        <select class="form-control input-xs @error('deskripsi_kasbon') is-invalid @enderror" name="deskripsi_kasbon" id="deskripsi_kasbon" data-live-search="true" required></select>
                                        @error('deskripsi_kasbon')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group @error('nominal_kasbon') has-warning has-feedback @enderror">
                                    <label class="control-label col-lg-4">Amount: <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" name="nominal_kasbon" id="nominal_kasbon" class="form-control input-xs" value="{{ old('nominal_kasbon') }}" required placeholder="Input Total Amount">
                                        @error('nominal_kasbon')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group @error('keterangan_tambahan') has-warning has-feedback @enderror">
                                    <label class="control-label col-lg-4">Keterangan Tambahan: </label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control input-xs" name="keterangan_tambahan" id="keterangan_tambahan" placeholder="Input keterangan tambahan, jika dibutuhkan" rows="2"></textarea>
                                        @error('keterangan_tambahan')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
        <!-- /small modal -->

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

<!-- {{-- SELECT PIC NAME --}} -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $('#name_pic').select2({
        placeholder: 'PILIH NAMA PIC',
        ajax: {
            url: '{{ route("HeadTeam.get_name_pic") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    console.log(item.valuenya);
                    return {
                        text: item.valuenya,
                        id: item.valuenya
                    }
                })
            };
            },
            cache: true
        }
    });

    $(document).ready(function(){

        $("#name_pic").click(function(){
            let keyword = '';
            $("#name_pic").keyup(function() {
                keyword = this.value;
                console.log(keyword);
            });

            $.ajax({
                url: "{{ route('HeadTeam.get_name_pic') }}",
                cache: false,
                success: function(data){
                    $("#name_pic").select2();
                    $("#name_pic").append(data);
                    
                  }
            });
        });

    });
</script>

<!-- {{-- SELECT DESKRIPSI KASBON --}} -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $('#deskripsi_kasbon').select2({
        placeholder: 'PILIH DESKRIPSI KASBON',
        ajax: {
            url: '{{ route("HeadTeam.get_deskripsi_kasbon") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    console.log(item.valuenya);
                    return {
                        text: item.valuenya,
                        id: item.valuenya
                    }
                })
            };
            },
            cache: true
        }
    });

    $(document).ready(function(){

        $("#deskripsi_kasbon").click(function(){
            let keyword = '';
            $("#deskripsi_kasbon").keyup(function() {
                keyword = this.value;
                console.log(keyword);
            });

            $.ajax({
                url: "{{ route('HeadTeam.get_deskripsi_kasbon') }}",
                cache: false,
                success: function(data){
                    $("#deskripsi_kasbon").select2();
                    $("#deskripsi_kasbon").append(data);
                    
                  }
            });
        });

    });
</script>

<!-- {{-- SELECT PROJECT NUMBER --}} -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $('#project_number').select2({
        placeholder: 'PILIH UNTUK NOMOR PROJECT MANA?',
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

    });
</script>

<!-- Fortmat input nominal  -->
<script>
    
    var total_amount = document.getElementById('total_amount');
    total_amount.addEventListener('keyup', function(e) {
        total_amount.value = formatRupiah(this.value);
    });
    var nominal_kasbon = document.getElementById('nominal_kasbon');
    nominal_kasbon.addEventListener('keyup', function(e) {
        nominal_kasbon.value = formatRupiah(this.value);
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