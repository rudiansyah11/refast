<!-- TITLE  -->
@section('title', 'Profile User')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<style>
    #content-mapbox {
        width: 100%; 
        height:500px;
    }
</style>
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default sidebar-separate">
            <div class="sidebar-content">

                <!-- User details -->
                <div class="content-group">
                    <div class="panel-body bg-slate-700 border-radius-top text-center">

                        <a href="#" class="display-inline-block content-group-sm">
                            <img src="{{ asset('assets/images/user_default.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                        </a>
                        <div class="content-group-sm">
                            <h6 class="text-semibold no-margin-bottom">
                                {{ Auth::user()->name }}
                            </h6>
                            <span class="display-block">{{ Auth::user()->name }}</span>
                        </div>
                    </div>

                    <div class="panel no-border-top no-border-radius-top">
                        <ul class="navigation">
                            <li class="navigation-header">Navigation</li>
                            <li><a href="#profile" data-toggle="tab"><i class="icon-files-empty"></i> Profil</a></li>
                            <li class="active"><a href="#absen" data-toggle="tab"><i class="icon-files-empty"></i> Log Absen</a></li>
                            <li><a href="#aktivitas" data-toggle="tab"><i class="icon-files-empty"></i> Log Aktivitas</a></li>
                            <!-- <li class="navigation-divider"></li>  -->
                        </ul>
                    </div>
                </div>
                <!-- /user details -->


                <!-- Partner Team -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>Partner Team</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content">
                        <ul class="media-list">
                            <li class="media">
                                <a href="#" class="media-left"><img src="{{ asset('assets/images/user_default.png') }}" class="img-sm img-circle" alt=""></a>
                                <div class="media-body">
                                    <a href="#" class="media-heading text-semibold">Users 1</a>
                                    <span class="text-size-mini text-muted display-block">Front End Dev</span>
                                </div>
                                <div class="media-right media-middle">
                                    <span class="status-mark border-success"></span>
                                </div>
                            </li>

                            <li class="media">
                                <a href="#" class="media-left"><img src="{{ asset('assets/images/user_default.png') }}" class="img-sm img-circle" alt=""></a>
                                <div class="media-body">
                                    <a href="#" class="media-heading text-semibold">Users 2</a>
                                    <span class="text-size-mini text-muted display-block">Back End Dev</span>
                                </div>
                                <div class="media-right media-middle">
                                    <span class="status-mark border-danger"></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /partner Team -->

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Tab content -->
            <div class="tab-content">
                <div class="tab-pane fade" id="profile">

                    <!-- Profile info -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title"><b>Profile Information</b>:</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form action="#" method="post">
                                @csrf
                                <div class="form-group">
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group @error('name') has-warning has-feedback @enderror">
                                            <label>Full Name:</label>
                                            <input type="text" value="{{ old('name') }}" class="form-control input-xs" placeholder="Enter Full name of Employee">
                                            @error('name')
                                            <div class="form-control-feedback">
                                                <i class="icon-notification2"></i>
                                            </div>
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-group @error('email') has-warning has-feedback @enderror">
                                            <label>Email:</label>
                                            <input type="text" name="email" value="{{ old('email') }}" class="form-control input-xs" placeholder="Enter Email of Employee">
                                            @error('email')
                                            <div class="form-control-feedback">
                                                <i class="icon-notification2"></i>
                                            </div>
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-4 form-group @error('role') has-warning has-feedback @enderror">
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
                                            <input type="number" value="{{ old('age') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
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
                                            <input type="text" value="{{ old('no_identity') }}" class="form-control input-xs" placeholder="Enter place birth of Employee">
                                            @error('no_identity')
                                            <div class="form-control-feedback">
                                                <i class="icon-notification2"></i>
                                            </div>
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 form-group @error('no_npwp') has-warning has-feedback @enderror">
                                            <label>No NPWP:</label>
                                            <input type="text" value="{{ old('no_npwp') }}" class="form-control input-xs" placeholder="Enter NPWP of Employee">
                                            @error('no_npwp')
                                            <div class="form-control-feedback">
                                                <i class="icon-notification2"></i>
                                            </div>
                                            <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 form-group @error('no_tlp') has-warning has-feedback @enderror">
                                            <label>No Telephone:</label>
                                            <input type="text" value="{{ old('no_tlp') }}" class="form-control input-xs" placeholder="Enter Number Telephone of Employee">
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
                                            <textarea rows="2" name="address" class="form-control" placeholder="Enter address of Employee" value="{{ old('address') }}"></textarea>
                                            @error('address')
                                                <div class="form-control-feedback">
                                                    <i class="icon-notification2"></i>
                                                </div>
                                                <span class="help-block" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" id="btn-save">Save <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /profile info -->

                    <!-- Account settings -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title"><b>Profile Contract: </b></h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <hr>
                            <form action="#" method="post">
                                <div class="form-group">
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
                                            <select name="working_area" class="form-control input-xs @error('working_area') is-invalid @enderror">
                                                <option value="">---</option>
                                                <option value="Jakarta Barat">Jakarta Barat</option>
                                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                <option value="Jakarta Timur">Jakarta Timur</option>
                                                <option value="Jakarta Utara">Jakarta Utara</option>
                                                @error('working_area')
                                                    <span class="help-block" role="alert">{{ $message }}</span>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /account settings -->
                </div>

                <div class="tab-pane fade in active" id="absen">
                    
                    <!-- Record Calender -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Record Calender</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                        <div class="schedule"></div>
                        </div>
                    </div>
                    <!-- /Record Calender -->

                    <!-- Record Map Location -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Record Map Location</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div id="content-mapbox"></div>
                        </div>
                    </div>
                    <!-- /Record Map Location -->

                    <!-- Log Absen -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">Log Absent</h6>

                            <div class="heading-elements not-collapsible">
                                <span class="label bg-green heading-text">Log 1 Tahun</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-inbox table-lg">
                                <tbody>
                                    @foreach($datanya['data_log_absen'] as $row)
                                    <?php
                                        if( $row->title == "Absent Alpha" ){
                                            $icon = "icon-star-empty3";
                                            $link = "href='".route('HeadTeam.absen_tidak_masuk', $row->passing_id)."'";
                                        } else {
                                            $icon = "icon-star-full2";
                                            $link = "href='#'";
                                        }
                                    ?>
                                    <tr> 
                                        <td class="table-inbox-star rowlink-skip">
                                            <a <?= $link;?> >
                                                <i class="<?= $icon;?> text-muted"></i>
                                            </a>
                                        </td>
                                        <td class="table-inbox-message">
                                            <a <?= $link;?> >
                                                <span class="table-inbox-preview"><b>{{ $row->title }}</b>, {{ $row->keterangan_other }} </span>
                                            </a>
                                        </td>
                                        <td class="table-inbox-time">
                                            <?php
                                                if( $row->title == "Absent Alpha" ){ ?>
                                                    <a href="{{route('HeadTeam.absen_tidak_masuk', $row->passing_id) }}" class="btn btn-sm btn-warning">Lihat</a>
                                                <?php } else { ?>
                                                    <a <?= $link;?> class="text-muted">
                                                        <?= date('H:i', strtotime($row->start_date)) ?>
                                                    </a>
                                                 <?php }
                                            ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <!-- /Log Absen -->
                </div>

                <div class="tab-pane fade" id="aktivitas">

                    <!-- Log Activity this year -->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">Log Activity</h6>

                            <div class="heading-elements not-collapsible">
                                <span class="label bg-green heading-text">Log 1 Bulan</span>
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-top:10px; padding:10px;">
                            <table class="table table-activity table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Type Activity</th>
                                        <th>Desctiption</th>
                                        <th>Date Activity</th>
                                    </tr>
                                </thead>
                                <tbody data-link="row" class="rowlink">
                                    @foreach($datanya['data_log_aktifitas'] as $row)
                                    <tr> 
                                        <td>
                                            <b>{{ $row->category_activity }}</b>
                                        </td>
                                        <td>
                                            <?= $row->the_activity ?>
                                        </td>
                                        <td>
                                            <?= date('d-m-Y H:i', strtotime($row->created_at)) ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /tab content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>


<!-- Alert -->
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

<!-- DataTables -->
<script>
    $('.table-activity').DataTable({
    });
</script>

<!-- SCHEDULE FULL CALENDER -->
<script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }

        });
        
        var schedule = $('.schedule').fullCalendar({
            editable:false,
            header:{
                left:'prev,next',
                center:'title',
                right:'month,agendaWeek'
            },
            events: '/HeadTeam/get_dataAbsent',
            selectable:true,
            selectHelper:true
        });

    });
</script>

<!-- LOCATION WITH MAPBOX -->
<script>
	//Need API TOKEN
	mapboxgl.accessToken = 'pk.eyJ1IjoicnVkaWFuc3lhaDExIiwiYSI6ImNreHp4NjdzdzlxOWcyb211enMwNmZnbWMifQ.VefqiJtENPBwL1yR1DZUHg';
    const map = new mapboxgl.Map({
        container: 'content-mapbox',
        style: 'mapbox://styles/mapbox/satellite-streets-v11',
        center: [107.0216959, -6.411401],
        zoom: 8.5
    });

	// map.addControl(
	// 	new MapboxDirections({
	// 		accessToken: mapboxgl.accessToken
	// 	}), 'top-left'
	// );

    // var tampungData = JSON.parse("{{ json_encode($datanya) }}");
    var tampungData = @json($datanya['data_posisi']);
    console.log(tampungData);

    map.on('load', () => {
        map.addSource('places', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': tampungData
            }
        });

        // Add a layer showing the places.
        map.addLayer({
            'id': 'places',
            'type': 'circle',
            'source': 'places',
            'paint': {
                'circle-color': '#ff0000',
                'circle-radius': 6,
                'circle-stroke-width': 2,
                'circle-stroke-color': '#ffffff'
            }
        });

        const popup = new mapboxgl.Popup({
			closeButton: false,
			closeOnClick: false
		});
		 
		map.on('mouseenter', 'places', (e) => {
			// Change the cursor style as a UI indicator.
			map.getCanvas().style.cursor = 'pointer';
			 
			// Copy coordinates array.
			const coordinates = e.features[0].geometry.coordinates.slice();
			const description = e.features[0].properties.description;
			 
			// Ensure that if the map is zoomed out such that multiple
			// copies of the feature are visible, the popup appears
			// over the copy being pointed to.
			while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
            }
		 
			// Populate the popup and set its coordinates
			// based on the feature found.
			popup.setLngLat(coordinates).setHTML(description).addTo(map);
		});
		 
		map.on('mouseleave', 'places', () => {
			map.getCanvas().style.cursor = '';
			popup.remove();
		});

        map.on('click', 'places', (e) => {
			// Change the cursor style as a UI indicator.
			map.getCanvas().style.cursor = 'pointer';
			 
			// Copy coordinates array.
			const coordinates = e.features[0].geometry.coordinates.slice();
			const description = e.features[0].properties.description;
			 
			// Ensure that if the map is zoomed out such that multiple
			// copies of the feature are visible, the popup appears
			// over the copy being pointed to.
			while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
            }
		 
			// Populate the popup and set its coordinates
			// based on the feature found.
			popup.setLngLat(coordinates).setHTML(description).addTo(map);
		});

    });
</script>
@endsection