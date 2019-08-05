<!doctype html>
<html lang="en">

<head>
	<title>Remit Portal</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="Portal to confirm Zeepay Remittances">
  <meta name="author" content="Zeepay Ghana (Dennis Machu)">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ url('/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ url('/vendor/linearicons/style.css') }}">
	<link rel="stylesheet" href="{{ url('/vendor/chartist/css/chartist-custom.css') }}">
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ url('/css/main.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ url('/css/demo.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.comcss?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ url('/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ url('/img/favicon.png') }}">

  @yield('added_styles')
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
    @include('blocks.navbar')
		<!-- LEFT SIDEBAR -->
		@can('isAdmin')
    	@include('blocks.left-sidebar')
		@endcan

		@can('is_bank_cm')
    	@include('blocks.left-sidebar')
		@endcan
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
    @yield('content')
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; {{ date("Y") }} Zeepay Ghana.All rights reserved.|Powered by: Zeepay</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{ url('/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ url('/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

  @yield('added_scripts')

</body>

</html>
