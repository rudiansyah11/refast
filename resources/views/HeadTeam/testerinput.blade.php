<!-- TITLE  -->
@section('title', 'Tester Create')

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
                        <h5 class="panel-title">Basic form inputs<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <p class="content-group-lg">Examples of standard form controls supported in an example form layout. Individual form controls automatically receive some global styling. All textual <code>&lt;input&gt;</code>, <code>&lt;textarea&gt;</code>, and <code>&lt;select&gt;</code> elements with <code>.form-control</code> are set to <code>width: 90%;</code> by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing. Labels in horizontal form require <code>.control-label</code> class.</p>

                        <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.insert_test') }}" method="POST">
                            <fieldset class="content-group">
                                <legend class="text-bold">Penambahan Barang</legend>
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group @error('nama_barang') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-2">Nama Barang</label>
                                            <div class="col-lg-9">
                                                <input type="text" name="nama_barang" class="form-control input-xs" value="{{ old('nama_barang') }}">
                                                @error('nama_barang')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group @error('stok_barang') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-2">Stok Barang</label>
                                            <div class="col-lg-9">
                                                <input type="number" name="stok_barang" class="form-control input-xs" value="{{ old('stok_barang') }}">
                                                @error('stok_barang')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group @error('jenis_barang') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-2">Jenis Barang</label>
                                            <div class="col-lg-9">
                                                <select name="jenis_barang" class="form-control input-xs @error('jenis_barang') is-invalid @enderror">
                                                    <option value="">---</option>
                                                    <option value="Makanan">Makanan</option>
                                                    <option value="Minuman">Minuman</option>
                                                    <option value="Rumah Tangga">Rumah Tangga</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                    @error('jenis_barang')
                                                        <span class="help-block" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group @error('harga_barang') has-warning has-feedback @enderror">
                                            <label class="control-label col-lg-2">Harga Barang <span class="text-danger">(Satuan)</span></label>
                                            <div class="col-lg-9">
                                                <input type="number" name="harga_barang" class="form-control input-xs" value="{{ old('harga_barang') }}">
                                                @error('harga_barang')
                                                    <div class="form-control-feedback">
                                                        <i class="icon-notification2"></i>
                                                    </div>
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group @error('keterangan_barang') has-warning @enderror">
                                            <label class="control-label col-lg-2">Keterangan</label>
                                            <div class="col-lg-9">
                                                <textarea rows="3" cols="3" name="keterangan_barang" class="form-control" placeholder="Default textarea" value="{{ old('keterangan_barang') }}"></textarea>
                                                @error('keterangan_barang')
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
                                    <img src="{{ asset('assets/spinner/spinner_double_ring.gif') }}" style="width: 65px; height: 60px;">
                                </div>
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

@endsection