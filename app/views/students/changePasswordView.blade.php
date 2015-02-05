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



<body id="signup">
	<div class="container animated fadeInDown">
		<div class="row header">
			<div class="col-md-12">
				<h4>Change Password!</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="wrapper clearfix">
					<div class="formy">
						<div class="row">

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

							<div class="col-md-12">
								{{ Form::open(array('url' => 'change_password')) }}
				  				<div class="form-group">
				    				<label for="old-password">Old Password*</label>
				    				<?php
				    				if($errors->first('old-password') == null)
			                		{
			                		?>
				   						<input type="password" class="form-control" name="old-password" id="old-password" placeholder="Enter your Old Password">
				   					<?php
				   					} else {
				   					?>
				   						<input type="password" class="form-control error-border" name="old-password" id="old-password" placeholder="Enter your Old Password">
				   					<?php
				   					}
				   					?>
				   					<?php echo "<span class='error-msg'>" . $errors->first('old-password') . "</span>"; ?>
				  				</div>
				  				<div class="form-group">
				    				<label for="new-password">New Password*</label>
				    				<?php
				    				if($errors->first('new-password') == null)
			                		{
			                		?>
				   						<input type="password" class="form-control" name="new-password" id="new-password" placeholder="Enter your New Password">
				   					<?php
				   					} else {
				   					?>
				   						<input type="password" class="form-control error-border" name="new-password" id="new-password" placeholder="Enter your New Password">
				   					<?php
				   					}
				   					?>
				   					<?php echo "<span class='error-msg'>" . $errors->first('new-password') . "</span>"; ?>
				  				</div>
				  				<div class="form-group">
				    				<label for="confirm-new-password">Confirm New Password*</label>
				    				<?php
				    				if($errors->first('confirm-new-password') == null)
			                		{
			                		?>
				   						<input type="password" class="form-control" name="confirm-new-password" id="confirm-new-password" placeholder="Confirm your New Password again">
				   					<?php
				   					} else {
				   					?>
				   						<input type="password" class="form-control error-border" name="confirm-new-password" id="confirm-new-password" placeholder="Confirm your New Password again">
				   					<?php
				   					}
				   					?>
				   					<?php echo "<span class='error-msg'>" . $errors->first('confirm-new-password') . "</span>"; ?>
				  				</div>

								<div class="submit">
						  			<a href="javascript:void(0)" class="button-clear js-form-submit">
							  			<span>Change Password</span>
							  		</a>
							  		&nbsp;&nbsp;
							  		<a href="{{ URL::route('view_students') }}">
							  			Cancel
							  		</a>
					  			</div>
							{{ Form::close() }}
							</div>
						</div>						
					</div>
				</div>
				<div class="already-account">
					<!--Already, have an account!
					<a href="{{ URL::route('login_view') }}">Sign In here</a>-->
				</div>
			</div>
		</div>
	</div>
</body>
	





</body>


@stop




	<!--
	@if(Auth::user())
	Logged In!
	@endif
	-->
	

    </body>
</html>