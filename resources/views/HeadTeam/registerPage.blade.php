<!-- TITLE  -->
@section('title', 'Register New Account')

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
                        <h5 class="panel-title">Register New Employee<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                            <h6 class="alert-heading text-semibold">Deskripsi untuk role/privileges:</h6>
                            - 1: Untuk Head Team (Super Admin / C-level) <br>
                            - 2: Untuk Oprator Team (Admin /Finance) <br>
                            - 3: Untuk Field Engineer(Teknisi Lapangan) <br>
                        </div> 

                        <form class="form-horizontal" id="form-submit" action="{{ route('HeadTeam.process_register') }}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <legend class="text-bold"><span class="icon-pencil7"></span> Register</legend>
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->name }}" name="creator">
                                
                                <div class="row">
                                    <div class="col-md-3 form-group @error('username') has-warning has-feedback @enderror">
                                        <label>Full Username:</label>
                                        <input type="text" name="username" value="{{ old('username') }}" class="form-control input-xs" placeholder="Enter Full username of Employee">
                                        @error('username')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 form-group @error('email') has-warning has-feedback @enderror">
                                        <label>Email:</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control input-xs" placeholder="Enter Email of Employee">
                                        @error('email')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 form-group @error('password') has-warning has-feedback @enderror">
                                        <label>password:</label>
                                        <input type="password" name="password" value="{{ old('password') }}" class="form-control input-xs" placeholder="Enter password of Employee">
                                        @error('password')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3 form-group @error('role') has-warning has-feedback @enderror">
                                        <label>Role / Privilege:</label>
                                        <select name="role" class="form-control input-xs @error('role') is-invalid @enderror">
                                            <option value="">---</option>
                                            <option value="1">Head Team</option>
                                            <option value="2">Oprator Team (Admin)</option>
                                            <option value="3">Field Team (Engineer)</option>
                                            @error('role')
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <legend class="text-bold"><span class="icon-cabinet"></span> Info Employee</legend>
                                <div class="row">
                                    <div class="col-md-4 form-group @error('place_birth') has-warning has-feedback @enderror">
                                        <label>Place Birth:</label>
                                        <input type="text" name="place_birth" value="{{ old('place_birth') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('place_birth')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group @error('date_birth') has-warning has-feedback @enderror">
                                        <label>Place Birth:</label>
                                        <input type="date" name="date_birth" value="{{ old('date_birth') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('date_birth')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group @error('age') has-warning has-feedback @enderror">
                                        <label>Age:</label>
                                        <input type="number" name="age" value="{{ old('age') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('age')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 form-group @error('type_identity') has-warning has-feedback @enderror">
                                        <label>Type Identity:</label>
                                        <select name="type_identity" class="form-control input-xs @error('type_identity') is-invalid @enderror">
                                            <option value="">---</option>
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                            <option value="Passport">Passport</option>
                                            @error('type_identity')
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group @error('no_identity') has-warning has-feedback @enderror">
                                        <label>No Identity:</label>
                                        <input type="text" name="no_identity" value="{{ old('no_identity') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('no_identity')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group @error('no_npwp') has-warning has-feedback @enderror">
                                        <label>No NPWP:</label>
                                        <input type="text" name="no_npwp" value="{{ old('no_npwp') }}" class="form-control input-xs" placeholder="Enter NPWP of Employee">
                                        @error('no_npwp')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group @error('no_tlp') has-warning has-feedback @enderror">
                                        <label>No Telephone:</label>
                                        <input type="text" name="no_tlp" value="{{ old('no_tlp') }}" class="form-control input-xs" placeholder="Enter Number Telephone of Employee">
                                        @error('no_tlp')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 form-group @error('religion') has-warning has-feedback @enderror">
                                        <label>Religion:</label>
                                        <select name="religion" class="form-control input-xs @error('religion') is-invalid @enderror">
                                            <option value="">---</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Other">Other</option>
                                            @error('religion')
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group @error('status_marital') has-warning has-feedback @enderror">
                                        <label>Status Marital:</label>
                                        <select name="status_marital" class="form-control input-xs @error('status_marital') is-invalid @enderror">
                                            <option value="">---</option>
                                            <option value="Merried">Merried</option>
                                            <option value="Single">Single</option>
                                            <option value="Divorce">Divorce</option>
                                            @error('status_marital')
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group @error('address') has-warning has-feedback @enderror">
                                        <label>Address:</label>
                                        <textarea rows="2" name="address" class="form-control" placeholder="Enter address of Employee">{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="form-control-feedback">
                                                <i class="icon-notification2"></i>
                                            </div>
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>
                                <legend class="text-bold"><span class="icon-magazine"></span> Info Contract</legend>
                                <div class="row">
                                    <div class="col-md-3 form-group @error('contract_date_start') has-warning has-feedback @enderror">
                                        <label>Contract Date (Join):</label>
                                        <input type="date" name="contract_date_start" value="{{ old('contract_date_start') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('contract_date_start')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group @error('contract_date_finish') has-warning has-feedback @enderror">
                                        <label>Contract Date (End):</label>
                                        <input type="date" name="contract_date_finish" value="{{ old('contract_date_finish') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('contract_date_finish')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group @error('position_employee') has-warning has-feedback @enderror">
                                        <label>Position Employee:</label>
                                        <select name="position_employee" class="form-control input-xs @error('position_employee') is-invalid @enderror">
                                            <option value="">---</option>
                                            <option value="CEO">CEO</option>
                                            <option value="Admin">Oprator / Admin</option>
                                            <option value="Field Oprator">Field Oprator / Engineer</option>
                                            @error('position_employee')
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group @error('level_employee') has-warning has-feedback @enderror">
                                        <label>Level Employee:</label>
                                        <select name="level_employee" class="form-control input-xs @error('level_employee') is-invalid @enderror">
                                            <option value="">---</option>
                                            <option value="CEO">CEO</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Leader">Leader</option>
                                            <option value="Other">Other</option>
                                            @error('level_employee')
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 form-group @error('status_employee') has-warning has-feedback @enderror">
                                        <label>Status Employee:</label>
                                        <select name="status_employee" class="form-control input-xs @error('status_employee') is-invalid @enderror">
                                            <option value="">---</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Permanent">Permanent</option>
                                            @error('status_employee')
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group @error('bpjs_tk') has-warning has-feedback @enderror">
                                        <label>BPJS Tenaga Kerja:</label>
                                        <input type="text" name="bpjs_tk" value="{{ old('bpjs_tk') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('bpjs_tk')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group @error('bpjs_ks') has-warning has-feedback @enderror">
                                        <label>BPJS Kesehatan:</label>
                                        <input type="text" name="bpjs_ks" value="{{ old('bpjs_ks') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                        @error('bpjs_ks')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group @error('working_area') has-warning has-feedback @enderror">
                                        <label>Working Area:</label>
                                        <select class="form-control input-xs @error('working_area') is-invalid @enderror" name="working_area" id="working_area" data-live-search="true"></select>
                                        @error('working_area')
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group @error('file_photo') has-warning has-feedback @enderror">
                                        <label>Photo_profile:</label>
                                        <input type="file" name="file_photo" value="{{ old('file_photo') }}" class="form-control input-xs">
                                        @error('file_photo')
                                        <div class="form-control-feedback">
                                            <i class="icon-notification2"></i>
                                        </div>
                                        <span class="help-block" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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


<!-- {{-- SELECT Area Working --}} -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $('#working_area').select2({
        placeholder: 'CHOOSE AREA',
        ajax: {
            url: '{{ route("HeadTeam.get_area") }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    console.log(item.city);
                    return {
                        text: item.city,
                        id: item.city
                    }
                })
            };
            },
            cache: true
        }
    });

    $(document).ready(function(){

        $("#working_area").click(function(){

            let keyword = '';
            $("#working_area").keyup(function() {
                keyword = this.value;
                console.log(keyword);
            });

            $.ajax({
                url: "{{ route('HeadTeam.get_area') }}",
                cache: false,
                success: function(data){
                    $("#working_area").select2();
                    $("#working_area").append(data);

                  }
            });
        });

    });
</script>
@endsection