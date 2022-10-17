<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Refast Indonesia - @yield('title')</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/drilldown.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/fullcalendar/fullcalendar.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js') }}"></script>
 	<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
  	<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/select.min.js') }}"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script> -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/purify.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/pnotify.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_notifications_pnotify.js') }}"></script>

	<!-- visualisasi chart, MATTIN CHART NYA KARNA NABRAK SAMA WEBCAM DAN MAPBOX -->
	<!-- <script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/echarts.js') }}"></script> -->

	<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_responsive.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_extension_buttons_html5.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/progressbar.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_loaders.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/uploader_bootstrap.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/webcamjs/webcam.min.js') }}"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>

	<!-- MapBox -->
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
	<script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>

	<!-- pluggin driving directions -->
	<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
	<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
	<style>
		.mapboxgl-ctrl-logo {
			display: none !important;
		}
		.mapboxgl-ctrl-attrib-inner{
			display: none !important;
		}
	</style>

	<style type="text/css">
		#preloader {
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 9999; 
			position: fixed;
			background-color: #fff;
		}

		#loadingnya {
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%); 
			position: absolute;
		}
	</style>

</head>

<body>

	<div id="preloader">
		<div id="loadingnya">
			<img src="{{ asset('assets/spinner/spinner_ripple.gif') }}">
		</div>
	</div>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header d-flex p-4">
			<a class="navbar-brand" href="#"><img src="{{ asset('assets/images/RefatLogo1.png') }}" style="width:50px; height:20px;" alt=""></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li>
					<a class="sidebar-control sidebar-main-hide hidden-xs">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
			<p class="navbar-text"><span class="label bg-success-400">Online</span></p>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('assets/images/user_default.png') }}" alt="">
						<span> {{ Auth::user()->name }} </span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{ route('HeadTeam.profile') }}"><i class="icon-cog5"></i> My profile</a></li>
						<li><a href="{{ route('HeadTeam.registerAccount') }}"><i class="icon-user-plus"></i> Register Account</a></li>
						<li class="divider"></li>
						<li class="nav-item dropdown">
							<div class="row">
								<div class="col-12">
									<form method="POST" action="{{ route('logout') }}">
										@csrf
										<div class="form-input text-center">
											<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to exit?');"><i class="icon-enter3 position-left"></i> Logout</button>
										</div>
									</form>
								</div>
							</div>
                        </li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-display4 position-left"></i> DASHBOARD <span class="caret"></span>
					</a>

					<ul class="dropdown-menu width-200">
						<li class="dropdown-header">Optional Dashboard</li>
						<li><a href=""><i class="icon-graph"></i> Dashboard 1</a></li>
						<li><a href=""><i class="icon-graph"></i> Dashboard 2</a></li>
						<li><a href=""><i class="icon-graph"></i> Dashboard 3</a></li>
						<li><a href=""><i class="icon-graph"></i> Dashboard 4</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-list-unordered position-left"></i> FEATURE <span class="caret"></span>
					</a>

					<ul class="dropdown-menu width-200">
						<li class="dropdown-header">All Feature</li>
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify3"></i> Inventory Management</a>
							<ul class="dropdown-menu">
								<li class="dropdown-header highlight">Fixed navbars</li>
								<li><a href="starters/layout_navbar_fixed_main.html">Fixed main navbar</a></li>
								<li><a href="starters/layout_navbar_fixed_secondary.html">Fixed secondary navbar</a></li>
								<li><a href="starters/layout_navbar_fixed_both.html">Both navbars fixed</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify3"></i> Oprational Management</a>
							<ul class="dropdown-menu">
								<li class="dropdown-header highlight">Sample Header</li>
								<li><a href="">Sample 1</a></li>
								<li><a href="">Sample 2</a></li>
								<li><a href="">Sample 3</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify3"></i> Absent</a>
							<ul class="dropdown-menu">
								<li class="dropdown-header highlight">Absent and Checkpoint</li>
								<li><a href="{{ route('HeadTeam.Absent') }}">Absent Entry & Out</a></li>
								<li><a href="{{ route('HeadTeam.checkpoint') }}">Check Point</a></li>
							</ul>
						</li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-hand position-left"></i> Absent <span class="caret"></span>
					</a>

					<ul class="dropdown-menu width-200">
						<li class="dropdown-header highlight">All Feature</li>
						<li><a href="{{ route('HeadTeam.Absent') }}">Absent Entry & Out</a></li>
						<li><a href="{{ route('HeadTeam.checkpoint') }}">Check Point</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cash3 position-left"></i> Financial Feature<span class="caret"></span>
					</a>

					<ul class="dropdown-menu width-200">
						<li class="dropdown-header">All Pages</li>
						<li><a href="{{ route('HeadTeam.rugilaba') }}"><i class="icon-stats-dots position-left"></i> Rugi Laba</a></li>
						<li><a href="{{ route('HeadTeam.penjualan') }}"><i class="icon-cart-remove position-left"></i> Penjualan</a></li>
						<li><a href="{{ route('HeadTeam.invoice') }}"><i class="icon-file-text3 position-left"></i> Invoice</a></li>
						<li><a href="{{ route('HeadTeam.kasbon') }}"><i class="icon-cash position-left"></i> Kasbon</a></li>
						<li><a href="{{ route('HeadTeam.realisasi') }}"><i class="icon-cash position-left"></i> Realisasi</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-files-empty position-left"></i> Optional Feature  <span class="caret"></span>
					</a>

					<ul class="dropdown-menu width-200">
						<li class="dropdown-header">Optional/Tambahan Feature</li>
						<li><a href="{{ route('HeadTeam.data_customer') }}"><i class="icon-users4"></i> Data Customer</a></li>
						<li><a href="{{ route('HeadTeam.registerAccount') }}"><i class="icon-user-plus"></i> Register Account</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-pen-plus position-left"></i> <span class="text-warning">DEVELOPMENT PAGE</span> <span class="caret"></span>
					</a>

					<ul class="dropdown-menu width-200">
						<li class="dropdown-header">All Pages</li>
						<li class="dropdown-submenu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify3"></i> Case Test</a>
							<ul class="dropdown-menu">
								<li class="dropdown-header highlight">Menu</li>
								<li><a href="{{ route('HeadTeam.dashboard_dev_1') }}">Dashboard</a></li>
								<li><a href="{{ route('HeadTeam.index_dev_1') }}">Show Data <span class="text-info">( ServerSide DataTable's )</span></a></li>
								<li><a href="{{ route('HeadTeam.testerinput') }}">Input Test</a></li>
								<li><a href="{{ route('HeadTeam.hitungjarak') }}">Test Hitung Jarak</a></li>
							</ul>
						</li>
						<li><a href="{{ route('HeadTeam.dataTransaksitest') }}"><i class="icon-circle-right2"></i> Show Data Buying</a></li>
						<li><a href="{{ route('HeadTeam.samplePage') }}"><i class="icon-pagebreak"></i> Template Page's</a></li>
					</ul>
				</li>

				<li>
					<a href="{{ route('HeadTeam.menu') }}"><i class="icon-menu4 position-left"></i> Menu</a>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<!-- SISI KANAN DIKOSONGIN AJA -->
			</ul>
		</div>
	</div>
	<!-- /second navbar -->

	<!-- Page container -->
    @yield('content')
	<!-- /page container -->


	<script type="text/javascript">
		$(document).ready(function(){
			$('#preloader').show();
			setTimeout(function(){
		        $('#preloader').delay('1000').fadeOut();
		    },500);

		        // Basic responsive configuration
    		$('.datatable-responsive').DataTable();
		});
	</script>


	<!-- Footer -->
	<div class="footer text-muted text-center">
		&copy; 2022. <a href="#">Refast Indonesia</a> - <span class="text-info"> Portal APPS 1.2</span>
	</div>
	<!-- /footer -->

</body>
</html>
