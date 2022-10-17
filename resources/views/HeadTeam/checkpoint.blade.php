<!-- TITLE  -->
@section('title', 'Check Point Page')

<!-- EXTENTION WITH HEADER  -->
@extends('HeadTeam.headers_head')

<!-- REQUIRE PAGE  -->
@section('content')
<!-- Page header -->


<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-info22 position-left"></i> <span class="text-semibold">Check Point</span> - Get Your Position</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <!-- <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-stats-bars text-primary"></i><span>Dashboard</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-box-add text-primary"></i> <span>Create New Data</span>
                </a>
                <a href="#" class="btn btn-link btn-float has-text">
                    <i class="icon-file-excel text-primary"></i> <span>Export to Excel</span>
                </a> -->
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

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">CheckPoint Feature</h5>
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
                        <div class="col-md-6">
                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-block btn-primary" id="accesscamera" data-toggle="modal" data-target="#modal_full"><i class="icon-location3 position-left"></i> Do to Check Point</button>
                            
                            <!-- Full width modal -->
                            <div id="modal_full" class="modal fade">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h5 class="modal-title">Full width modal</h5>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <div id="my_camera" class="d-block mx-auto rounded overflow-hidden border border-secondary mb-3"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div id="results" class="d-none mt-3"></div>
                                                </div>
                                            </div>
                                            <form method="post" id="photoForm" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="photoStore" name="photoStore" value="">
                                                <input type="text" id="latitude" name="latitude">
                                                <input type="text" id="longitude" name="longitude">
                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto">Capture</button>
                                            <!-- <button type="button" class="btn btn-warning mx-auto text-white d-none" id="retakephoto">Retake</button> -->
                                            <button type="submit" class="btn btn-success mx-auto text-white d-none" id="uploadphoto" form="photoForm">Upload</button>
                                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /full width modal -->

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Your History CheckPoint</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="content-mapbox" style="width: 100%; height:600px;"></div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- get your location -->
<script>
    getLocation();
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        console.log("Geolocation is found :) .");
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
    }
</script>

<script>
    $(document).ready(function() {
        // $("#uploadphoto").prop('disabled', true);

        Webcam.set({
            width: 550,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        $('#accesscamera').on('click', function() {
            Webcam.reset();
            Webcam.on('error', function() {
                $('#photoModal').modal('hide');
                swal({
                    title: 'Warning',
                    text: 'Please give permission to access your webcam',
                    icon: 'warning'
                });
            });
            Webcam.attach('#my_camera');
        });

        $('#takephoto').on('click', take_snapshot);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }

        });

        $('#photoForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("HeadTeam.processCheckpoint") }}',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data == 'success') {
                        Webcam.reset();

                        $('#my_camera').addClass('d-block');
                        $('#my_camera').removeClass('d-none');

                        $('#results').addClass('d-none');

                        $('#takephoto').addClass('d-block');
                        $('#takephoto').removeClass('d-none');


                        $('#uploadphoto').addClass('d-none');
                        $('#uploadphoto').removeClass('d-block');

                        $('#photoModal').modal('hide');

                        swal({
                            title: 'Success',
                            text: 'Photo uploaded successfully',
                            icon: 'success',
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            timer: 1000
                        })

                        window.location.replace('/HeadTeam/checkpoint');
                    }
                    else {
                        swal({
                            title: 'Error',
                            text: 'Mohon untuk ambil gambar terlebih dahulu',
                            icon: 'error'
                        })
                    }
                }
            })
        })
    });

    function take_snapshot(){
        //take snapshot and get image data
        Webcam.snap(function(data_uri) {
            //display result image
            $('#results').html('<img src="' + data_uri + '" class="d-block mx-auto rounded"/>');

            var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
            $('#photoStore').val(raw_image_data);
        });

        $('#my_camera').removeClass('d-block');
        $('#my_camera').addClass('d-none');

        $('#results').removeClass('d-none');

        $('#takephoto').removeClass('d-block');
        $('#takephoto').addClass('d-none');

    }
</script>

<script>
	//Need API TOKEN
	mapboxgl.accessToken = 'pk.eyJ1IjoicnVkaWFuc3lhaDExIiwiYSI6ImNreHp4NjdzdzlxOWcyb211enMwNmZnbWMifQ.VefqiJtENPBwL1yR1DZUHg';
    const map = new mapboxgl.Map({
        container: 'content-mapbox',
        style: 'mapbox://styles/mapbox/satellite-streets-v11',
        center: [107.0216959, -6.411401],
        zoom: 9
    });

	// map.addControl(
	// 	new MapboxDirections({
	// 		accessToken: mapboxgl.accessToken
	// 	}), 'top-left'
	// );

    // var tampungData = JSON.parse("{{ json_encode($datanya) }}");
    var tampungData = @json($datanya);
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
			// Copy coordinates array.
			const coordinates = e.features[0].geometry.coordinates.slice();
			const description = e.features[0].properties.description;
			 
			// Ensure that if the map is zoomed out such that multiple
			// copies of the feature are visible, the popup appears
			// over the copy being pointed to.

			while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
				coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
			}

			document.getElementById("information").innerHTML = description;
		});

    });
</script>
@endsection