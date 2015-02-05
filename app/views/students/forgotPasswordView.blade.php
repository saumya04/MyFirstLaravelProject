@extends('students.layout')

@section('content')


<?php 
if(!isset($student->id))
	{
        $new_arr = Input::get();
	}
?>

<?php
	if(!isset($student) && !isset($new_arr))
	{
	    echo "<p class='bg-danger'>Error!</p>";
	}
 ?>

<body id="signup">
	<div class="container animated fadeInDown">
		<div class="row header">
			<div class="col-md-12">
			<strong>
				<center>
					<a href="{{ URL::route('view_students') }}">
            <img src="<?php  echo asset('images/StudentAppLogo.png'); ?>" width="250" height="auto" class="brand-logo-big">
          </a>
				</center>
			</strong>
				<h4>Forgot Password!</h4>
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
								{{ Form::open(array('url' => 'forgot_password')) }}
				  				<div class="form-group">
				    				<label for="email">Email</label>
				    				<?php
				    				if($errors->first('email') == null)
			                		{
			                		?>
				   						<input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
				   					<?php
				   					} else {
				   					?>
				   						<input type="email" class="form-control error-border" name="email" id="email" placeholder="Enter email">
				   					<?php
				   					}
				   					?>
				   					<?php echo "<span class='error-msg'>" . $errors->first('email') . "</span>"; ?>
				  				</div>
				  				
				  				<div class="submit">
						  			<a href="javascript:void(0)" class="button-clear js-form-submit">
							  			<span>Send Email</span>
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
