<html>
	<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
	<title>{{ $title }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- jQuery - 1.10.2 -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	<!-- stylesheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo asset('css/compiled/theme.css'); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php  echo asset('css/datepicker3.css'); ?>">
	
	<link rel="stylesheet" type="text/css" href="<?php  echo asset('css/vendor/ionicons.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php  echo asset('css/vendor/font-awesome.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php  echo asset('css/vendor/entypo.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php  echo asset('css/vendor/animate.css'); ?>">
	<style type="text/css">
		.error-msg, .msg{
			color: #EF7C61;
		}
		.navbar-brand {
			padding: 10px 15px !important;
		}
		.brand-logo-big {
			margin-top: 30px;
		}
		.animated {
			-webkit-animation-duration: 1s;
		}
		#support {
			background-color: #F4F7FA;
		}
		.delete_form {
			display: inline-block;
			margin-bottom: 0;
		}
		.select_interests {
			display: block;
			margin-bottom: 3px;
		}
		span.clone, span.remove {
			cursor: pointer;
			margin-left: 8px;
		}
	</style>

</head>

		@yield('header')

    @yield('content')

<!-- javascript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="<?php  echo asset('js/bootstrap/bootstrap.min.js'); ?>"></script>
	<script src="<?php  echo asset('js/theme.js'); ?>"></script>
	<script src="<?php  echo asset('js/search.js'); ?>"></script>

	<script type="text/javascript" src="<?php  echo asset('js/bootstrap-datepicker.js'); ?>" charset="UTF-8"></script>
	<script src="<?php  echo asset('js/jquery.validate.js'); ?>"></script>
	<script src="<?php  echo asset('js/myScripts.js'); ?>"></script>