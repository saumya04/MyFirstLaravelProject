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
				<li>
					@if(Auth::user())
						<a class="" href="{{ URL::route('change_password_view') }}">Change Password</a>
					@endif
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

<?php

	$count = 1; // Value of count when @ Homepage without any pagination occurs
	$page_var = parse_url(URL::full());
	
	// Value of count when pagination occurs
	if(isset($page_var['query']))
	{
		$page_var = explode("=", $page_var['query']);
		$count = ($page_var['1'] * $limit) - $limit + 1;
	}
	

?>


<body id="support">

	<div class="container animated fadeInDown">
		<div class="row">
			<div class="col-md-12">

				<?php 
					if(Session::get('message') != null)
					{
					?>
						<?php
						if(Session::get('msg_tag') == "success")
						{
						?>
							<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong> {{ Session::get('message') }} </strong>
							</div>
						<?php
						}
						else
						{
						?>
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong> {{ Session::get('message') }} </strong>
							</div>
						<?php
						}
						?>
						
					<?php
					}
				?>

				<center>
				<h2>
					Search Students?
				</h2>
				</center>
				<form>
					<center>
					<div class="form-group">
						<input type="text" id="search-input" class="form-control" placeholder="Enter Keywords Here.." onkeydown="down()" onkeyup="up()">		
					</div>
					<div id="search-results">
						
					</div>
					</center>
				</form>
				<center>
				<div class="hideElement">

				<center>
				<?php
					if(count($total_students) > 0)
						echo "<div class='label label-success'>Total Students:&nbsp;" . count($total_students) . "</div><br>";
					else
						echo "<div class='label label-danger'>" . "&nbsp;No Students present in DB</div><br>";
				?>
				</center>

				<table style="border: 1px solid #DDD;" class="table table-hover">

				<?php 

				if(isset($students)) : foreach($students as $key => $value)
				{
					
				?>
					
					<h2>
						<tr><td valign="middle">
						<?php echo $count++; ?>
						.&nbsp;&nbsp;
						<?php echo $value->name ?>
						</td><td>
						<small>&nbsp;&nbsp;
						<a class="btn btn-info btn-xs" href='<?php echo URL::route('show', $value->id); ?>'>View</a>
						&nbsp;
						<a class="btn btn-warning btn-xs" href='<?php echo "students/$value->id/edit" ?>'>Edit</a>
						&nbsp;
						@if(Auth::user()->id == $value->id)
			              {{ Form::open(array('method' => 'delete', 'route' => ['students.destroy', $value->id], 'class' => 'delete_form' )) }}
			                <button type="submit" class="btn btn-danger btn-xs" disabled="disabled" data-toggle="tooltip" data-placement="right" title="Can't Delete Yourself!">Delete</button>
			              {{ Form::close() }}
						@else
			              {{ Form::open(array('method' => 'delete', 'route' => ['students.destroy', $value->id], 'class' => 'delete_form' )) }}
			                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
			              {{ Form::close() }}
						@endif
						</small>
						</td>
						</tr>
					</h2>
						
				<?php } ?>

				</table>

				<!-- PAGINATION -->
				<center><div class="pagination"> {{ $students->links() }} </div></center>

				<?php else : ?>

					<p class="bg-danger">No Records present in the DB..!!</p>

				<?php endif; ?>

				</div>
				</center>
			</div>
		</div>
	</div>




</body>


@stop