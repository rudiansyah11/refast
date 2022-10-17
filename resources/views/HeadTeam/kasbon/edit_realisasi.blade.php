<!-- TITLE  -->
@section('title', 'Show Realisasi')

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
                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Show Realisasi<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <fieldset class="content-group">
                                        <legend class="text-bold"> </legend>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Nama PIC:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="pic" id="pic" class="form-control input-xs" value="{{ $datanya['data_realisasi']->pic }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">No Realisasi:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="no_realisasi" id="no_realisasi" class="form-control input-xs" value="{{ $datanya['data_realisasi']->no_realisasi }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">No Nota:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="no_nota" id="no_nota" class="form-control input-xs" value="{{ $datanya['data_realisasi']->no_nota }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Amount:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="total_amount" id="total_amount" class="form-control input-xs" value="{{ number_format($datanya['data_realisasi']->amount, 0, '.', '.') }}" required readonly>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Amount Return:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="total_amount" id="total_amount" class="form-control input-xs" value="{{ number_format($datanya['data_realisasi']->amount_return, 0, '.', '.') }}" required readonly>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Kasbon<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <fieldset class="content-group">
                                        <legend class="text-bold"> </legend>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Nama PIC:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="pic" id="pic" class="form-control input-xs" value="{{ $datanya['data_kasbon']->pic }}" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Amount Kasbon:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="total_amount" id="total_amount" class="form-control input-xs" value="{{ number_format($datanya['data_kasbon']->total_amount, 0, '.', '.') }}" required readonly>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Over or Under: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="over_or_under" class="form-control input-xs" value="{{ $datanya['data_kasbon']->over_under }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Nominal Result: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="resultnya" class="form-control input-xs" value="{{ number_format($datanya['data_kasbon']->resultnya, 0, '.', '.')  }}" readonly>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Payment:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="payment" id="payment" class="form-control input-xs" value="{{ $datanya['data_kasbon']->payment }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Tanggal Transfer: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="date_transfer" id="date_transfer" class="form-control input-xs" value="{{ $datanya['data_kasbon']->tgl_transfer }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Statusnya: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="statusnya" id="statusnya" class="form-control input-xs" value="{{ $datanya['data_kasbon']->statusnya }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">No Realisasi: </label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="no_realisasi" id="no_realisasi" class="form-control input-xs" value="{{ $datanya['data_kasbon']->no_realisasi }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Tanggal Realisasi: </label>
                                                    <div class="col-lg-8">
                                                        <input type="date" name="tgl_realisasi" id="tgl_realisasi" class="form-control input-xs" value="{{ $datanya['data_kasbon']->tgl_realisasi }}" required readonly>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Show Realisasi<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                                        <table class="table table-striped table-bordered table-sm table-responsive">
                                            <thead style="background-color:#28343a;color: #FFF">
                                                <tr>
                                                    <th class="text-center">Deskripsi</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th class="text-center">Approval</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @if( $datanya['data_deskripsi']->isEmpty() )
                                                    <tr>
                                                        <td colspan="4"><h6 class="text-muted">Data belum ada!</h6></td>
                                                    </tr>
                                                @else
                                                    @foreach($datanya['data_deskripsi'] as $row)
                                                    <tr>
                                                        <td>{{ $row->deskripsi_kasbon }}</td>
                                                        <td>{{ $row->keterangan }}</td>
                                                        <td>
                                                            @if($row->approvalnya == "approved")
                                                            <span class="label label-info">APPROVED</span>
                                                            @elseif($row->approvalnya == "notapproved")
                                                            <span class="label label-danger">NOT APPROVED</span>
                                                            @else
                                                            <span class="label label-warning">?</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($row->amount, 0, '.', '.') }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="1">Grand Total: </td>
                                                        <?php
                                                            $checkout = $datanya['data_kasbon']->total_amount - $datanya['total_nominal_desc'];

                                                            if($checkout == 0){
                                                                $color = "#5bc0de";
                                                                $hasilnya = "Pas - ";

                                                            } else if($checkout > 0){
                                                                $color = "#22bb33";
                                                                $hasilnya = "Kelebihan";

                                                            } else if($checkout < 0){
                                                                $color = "#bb2124";
                                                                $hasilnya = "Kurang";
                                                            }
                                                        ?>
                                                        <td colspan="2" style="background-color: <?= $color;?>; color:white;">
                                                            <?= $hasilnya; ?> {{ number_format($checkout, 0, '.', '.') }}
                                                        </td>
                                                        <td colspan="1" style="background-color: <?= $color;?>; color:white;">
                                                            {{ number_format($datanya['total_nominal_desc'], 0, '.', '.') }}
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
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
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