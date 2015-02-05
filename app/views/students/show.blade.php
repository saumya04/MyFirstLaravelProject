
@extends('students.layout')

@section('header')
	<header class="navbar navbar-inverse normal" role="banner">
	<div class="container">
	<div class="navbar-header">
      	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
      	</button>
		

		<a href="{{ URL::route('view_students') }}" class="navbar-brand animated FlipInX">
      <img src="<?php  echo asset('images/StudentAppLogo.png'); ?>" width="180" height="auto" class="brand_logo">
    </a>
	</div>

	<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">				
				<li>
					<a class="" href="{{ URL::route('new_student') }}" >Add New Student</a>
				</li>
				<li>
					<a class="" href="{{ URL::route('view_students') }}">List all Students</a>
				</li>
			</ul>

				
			<ul class="nav navbar-nav navbar-right visible-md visible-lg">
				<li>
  				<a href="{{ URL::route('logout') }}" class="button">Logout</a>
				</li>
			</ul>
	</nav>
	</div>
</header>
@stop


@section('content')

<body id="status">

	<div id="update">
		<div class="container animated fadeInDown">
			<!-- <div class="row header">
				<h3>React System Status</h3>
				<p>Current status and incident report</p>
			</div> -->
			<div class="row">
				<div class="col-md-12">
					<div class="current-status">
						<center>
							<div class="status">
								<a href="{{ URL::route('view_students') }}" style="float: left;" class="btn btn-sm btn-success back">&lt;&lt; Go Back</a>
								<strong>{{ $student->name }}'s Profile</strong>
			<a href="{{ URL::route('edit', $student->id) }}" style="float: right;" class="btn btn-sm btn-info edit">Edit</a>
							</div>
						</center>					
					</div>
				</div>
			</div>
			<strong>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default modules">
					  <!-- List group -->
					  <ul class="list-group">
					    <li class="list-group-item">
					    	Email
					    	<div class="status">{{ $student->email }}</div>
					    </li>
					    <li class="list-group-item">
					    	Address
					    	<div class="status">{{ $student->address }}</div>
					    </li>
					    <li class="list-group-item">
					    	Gender
					    	<div class="status">
					    		@if($student->gender == 'M')
		  							Male
		  						@else
		  							Female
		  						@endif
					    	</div>
					    </li>
					    <li class="list-group-item">
					    	Date Of Birth
					    	<div class="status">{{ date("jS M, Y", strtotime($student->dob)) }}</div>
					    </li>
					    <li class="list-group-item">
					    	Passing Year
					    	<div class="status">{{ $student->year }}</div>
					    </li>
					    <li class="list-group-item">
					    	Interests
					    	<div class="status">
					    		@foreach($interests_arr as $key => $value)
		  							@if($key != 0)
		  								/
		  							@endif
		  								{{$value}}
		  						@endforeach
					    	</div>
					    </li>
					  </ul>
					</div>
				</div>
			</div>
			</strong>

		</div>
	</div>

<script type="text/javascript">
	$(function () {
		// Update the status color every 2 seconds, for demo only
		// You can remove this!
		var $status = $(".status .color"),
			colors = ["green", "yellow", "red"],
			currentStatus = 0;

		function updateStatus() {
			currentStatus++;
			if (currentStatus >= 3) {
				currentStatus = 0;
			}
			color = colors[currentStatus];
			$status.removeClass().addClass("color").addClass(color);
		}

		setInterval(function () {
			updateStatus();
		}, 2000);
	});
</script>

</body>

@stop




	