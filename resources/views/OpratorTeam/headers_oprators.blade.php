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
	<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/pnotify.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/components_notifications_pnotify.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/datatables_responsive.js') }}"></script>
	<!-- /theme JS files -->

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
                        <li><a href="{{ route('OpratorTeam.profile') }}"><i class="icon-cog5"></i> My profile</a></li>
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
								<li><a href="">Fixed main navbar</a></li>
								<li><a href="">Fixed secondary navbar</a></li>
								<li><a href="">Both navbars fixed</a></li>
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
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify3"></i> Sample Management</a>
							<ul class="dropdown-menu">
								<li class="dropdown-header highlight">Sample Header</li>
								<li><a href="">Sample 1</a></li>
								<li><a href="">Sample 2</a></li>
								<li><a href="">Sample 3</a></li>
							</ul>
						</li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-list-unordered position-left"></i> OPTIONAL PAGE <span class="caret"></span>
					</a>

					<ul class="dropdown-menu width-200">
						<li class="dropdown-header">All Pages</li>
						<li><a href="{{ route('OpratorTeam.showdatatest') }}"><i class="icon-gallery"></i> Show Data Test</a></li>
						<li><a href="{{ route('OpratorTeam.dataTransaksitest') }}"><i class="icon-circle-right2"></i> Show Data Buying</a></li>
						<li><a href="{{ route('OpratorTeam.samplePage') }}"><i class="icon-pagebreak"></i> Template Page's</a></li>
						<li><a href=""><i class="icon-git-compare"></i> Sample 1</a></li>
					</ul>
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
		&copy; 2022. <a href="#">Refast Indonesia</a> - <span class="text-info">Management Sistem 1.1</span>
	</div>
	<!-- /footer -->

</body>
</html>
