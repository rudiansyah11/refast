<!-- TITLE  -->
@section('title', 'Edit Deskripsi Kasbon')

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
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Edit Deskripsi <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <form class="form-horizontal" id="form-submit" action="{{route('HeadTeam.updateprocessdeskripsi')}}" method="POST" >
                                    <fieldset class="content-group">
                                        @csrf
                                        <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                        <input type="hidden" value="{{ $datanya['passing_id'] }}" name="passing_id">
                                        <input type="hidden" value="{{ $datanya['data_deskripsi']->id }}" name="idnya">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">No Kasbon:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="no_kasbon" id="no_kasbon" class="form-control input-xs" value="{{ $datanya['data_deskripsi']->no_kasbon }}" required readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group @error('deskripsi_kasbon') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Deskripsi Kasbon: <span class="text-danger">*</span> </label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control input-xs @error('deskripsi_kasbon') is-invalid @enderror" name="deskripsi_kasbon" id="deskripsi_kasbon" data-live-search="true" required>
                                                            <option value="{{ $datanya['data_deskripsi']->deskripsi_kasbon }}">{{ $datanya['data_deskripsi']->deskripsi_kasbon }}</option>
                                                        </select>
                                                        @error('deskripsi_kasbon')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group @error('nominal_kasbon') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Amount: <span class="text-danger">*</span></label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="nominal_kasbon" id="nominal_kasbon" class="form-control input-xs" value="{{ number_format($datanya['data_deskripsi']->amount, 0, '.', '.')  }}" required placeholder="Input Total Amount">
                                                        @error('nominal_kasbon')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group @error('keterangan_tambahan') has-warning has-feedback @enderror">
                                                    <label class="control-label col-lg-4">Keterangan Tambahan: </label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control input-xs" name="keterangan_tambahan" id="keterangan_tambahan" placeholder="Input keterangan tambahan, jika dibutuhkan" rows="2">{{ $datanya['data_deskripsi']->keterangan }}</textarea>
                                                        @error('keterangan_tambahan')
                                                        <div class="form-control-feedback">
                                                            <i class="icon-notification2"></i>
                                                        </div>
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Approval <span class="text-danger">*</span></label>
                                                    @if($datanya['data_deskripsi']->approvalnya == "approved")
                                                        <div class="form-check checkbox-inline">
                                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio1" value="approved" checked>
                                                            <label class="form-check-label" for="inlineRadio1">Approved</label>
                                                        </div>
                                                        <div class="form-check checkbox-inline">
                                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio2" value="notapproved">
                                                            <label class="form-check-label" for="inlineRadio2">Not Approved</label>
                                                        </div>
                                                    @elseif($datanya['data_deskripsi']->approvalnya == "notapproved")
                                                        <div class="form-check checkbox-inline">
                                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio1" value="approved">
                                                            <label class="form-check-label" for="inlineRadio1">Approved</label>
                                                        </div>
                                                        <div class="form-check checkbox-inline">
                                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio2" value="notapproved" checked>
                                                            <label class="form-check-label" for="inlineRadio2">Not Approved</label>
                                                        </div>
                                                    @else 
                                                        <div class="form-check checkbox-inline">
                                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio1" value="approved">
                                                            <label class="form-check-label" for="inlineRadio1">Approved</label>
                                                        </div>
                                                        <div class="form-check checkbox-inline">
                                                            <input class="form-check-input" type="radio" name="approval" id="inlineRadio2" value="notapproved">
                                                            <label class="form-check-label" for="inlineRadio2">Not Approved</label>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <div class="loader">
                                                <img src="{{ asset('assets/spinner/spinner.gif') }}" style="width: 65px; height: 60px;">
                                            </div>
                                            <a href="{{route('HeadTeam.create_realisasi', $datanya['passing_id'])}}" class="btn btn-danger">Kembali <i class="icon-backspace2 position-right"></i></a>
                                            <button type="submit" class="btn btn-primary" id="btn-submit">Buat <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>

                                    </fieldset>
                                </form>

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