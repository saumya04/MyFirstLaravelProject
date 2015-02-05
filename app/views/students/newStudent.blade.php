@extends('students.layout')

@if(Auth::user())
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
					
          <a class="" href="{{ URL::route('change_password_view') }}">Change Password</a>
					
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
@endif

@section('content')
        

	
	

<body id="signup">
	<div class="container animated fadeInDown">
		<div class="row header">
			<div class="col-md-12">
				@if(!Auth::user())
					<strong>
					<center>
						<a href="{{ URL::route('view_students') }}">
              <img src="<?php  echo asset('images/StudentAppLogo.png'); ?>" width="250" height="auto" class="brand-logo-big">
            </a>
					</center>
				</strong>
				@endif
				<h4>Create your new Account!</h4>
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
								if(Session::get('msg-tag') == 'success')
								{
								?>
									<div class="alert alert-success alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Success! </strong> {{ Session::get('message') }}
									</div>
								<?php
								} else {
								?>
									<div class="alert alert-danger alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Error! </strong> {{ Session::get('message') }}
									</div>
								<?php } ?>
							<?php
							}
							?>


							<?php
								if(Input::old('interests') != null)
								{
									$new_arr = Input::old();
								}
							?>

							<div class="col-md-12">
								<?php echo Form::open(array('url' => URL::route('students.store'))); ?>

								<p>
									<?php 
										echo Form::label('name', 'Name*');
										if($errors->first('name') == null)
						                {
											echo Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Enter your Full Name'));
										}
										else
										{
											echo Form::text('name', Input::old('name'), array('class' => 'form-control error-border', 'placeholder' => 'Enter your Full Name'));
										}
										echo "<span class='error-msg'>" . $errors->first('name') . "</span>";
									?>
								</p>

								<p>
									<?php 
										echo Form::label('email', 'Email*');
										if($errors->first('email') == null)
						                {
											echo Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Enter your working Email Id'));
										}
										else
										{
											echo Form::text('email', Input::old('email'), array('class' => 'form-control error-border', 'placeholder' => 'Enter your working Email Id'));
										}
										echo "<span class='error-msg'>" . $errors->first('email') . "</span>";
									?>
								</p>

								<p>
									<?php
										echo Form::label('password', 'Password*');
										if($errors->first('password') == null)
						                {
						                	echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Strong Password'));
						                }
						                else
						                {
						                	echo Form::password('password', array('class' => 'form-control error-border', 'placeholder' => 'Enter Strong Password'));                	
						                }
						                echo "<span class='error-msg'>" . $errors->first('password') . "</span>";
									?>			
								</p>

								<p>
									<?php
										echo Form::label('confirm_password', 'Confirm Password*');
										if($errors->first('confirm_password') == null)
						                {
						                	echo Form::password('confirm_password', array('class' => 'form-control', 'placeholder' => 'Write your Password Again!'));
						                }
						                else
						                {
						                	echo Form::password('confirm_password', array('class' => 'form-control error-border', 'placeholder' => 'Write your Password Again!'));                	
						                }
						                echo "<span class='error-msg'>" . $errors->first('confirm_password') . "</span>";
									?>			
								</p>

								<p>
									<?php 
										echo Form::label('dob', 'Date of Birth*');
										if($errors->first('dob') == null)
						        {
											echo Form::text('dob', Input::old('dob'), array('class' => 'form-control', 'placeholder' => 'Click to pick the Date'));
										}
										else
										{
											echo Form::text('dob', Input::old('dob'), array('class' => 'form-control error-border', 'placeholder' => 'Click to pick the Date'));					
										}
										echo "<span class='error-msg'>" . $errors->first('dob') . "</span>";
									?>
								</p>

								<p>
									<?php 
										echo Form::label('address', 'Address*');
										if($errors->first('address') == null)
						                {
											echo Form::textarea('address', Input::old('address'), array('class' => 'form-control', 'placeholder' => 'Enter your Full Address'));
										}
										else
										{
											echo Form::textarea('address', Input::old('address'), array('class' => 'form-control error-border', 'placeholder' => 'Enter your Full Address'));					
										}
										echo "<span class='error-msg'>" . $errors->first('address') . "</span>";
									?>
								</p>

								<p>
									<?php
											echo Form::label('gender', 'Gender*');
											if(Input::old('gender') == 'M')
											{
												echo "<br>";
												echo Form::radio('gender', 'M', TRUE);
												echo "&nbsp;Male<br>";
												echo Form::radio('gender', 'F');
												echo "&nbsp;Female<br>";
											}
											else if(Input::old('gender') == 'F')
											{
												echo "<br>";
												echo Form::radio('gender', 'M');
												echo "&nbsp;Male<br>";
												echo Form::radio('gender', 'F', TRUE);
												echo "&nbsp;Female<br>";
											}
											else
											{
												echo "<br>";
												echo Form::radio('gender', 'M');
												echo "&nbsp;Male<br>";
												echo Form::radio('gender', 'F');
												echo "&nbsp;Female<br>";
											}
											echo "<span class='error-msg'>" . $errors->first('gender') . "</span>";

									?>
								</p>

								<p>
									<label for="year">Expected Year of Passing:</label><br>
									<select name="year">				
									<?php

										$flag = "";
										$flag2015 = "";
										$flag2016 = "";
										$flag2017 = "";
										$flag2018 = "";
										
										if(Input::old('year') == null)
										{
											$flag2015 = "";
											$flag2016 = "";
											$flag2017 = "";
											$flag2018 = "";
											$flag = "selected";
										}
										else
										{
											if(Input::old('year') == "2015")
												$flag2015 = "selected";
											elseif (Input::old('year') == "2016")
												$flag2016 = "selected";
											elseif (Input::old('year') == "2017")
												$flag2017 = "selected";
											elseif (Input::old('year') == "2018")
												$flag2018 = "selected";
											else
												$flag = "selected";
										}
	

									?>
										  <option value="" disabled="disabled" <?php echo $flag ?> >Select Year</option>
									  	<option value="2015" <?php echo $flag2015 ?> >2015</option>
									  	<option value="2016" <?php echo $flag2016 ?> >2016</option>
									  	<option value="2017" <?php echo $flag2017 ?> >2017</option>
									  	<option value="2018" <?php echo $flag2018 ?> >2018</option>
									</select>
								</p>

								<br>

								<!-- <p>
									<label>Extra Curricular Interests:</label><br> -->

									<?php

                    /*if(Input::old('interests') == null)
                    {
                      foreach($interests as $row)
                      {
                        echo "<input type=\"checkbox\" name=\"interests[]\" value=\"$row->id\">&nbsp;&nbsp;$row->name<br>";
                      }
                    }
                    else
                    {
                      $interests_arr = Input::old('interests');
                      foreach($interests as $row)
                      {
                        if(in_array($row->id, $interests_arr))
                          echo "<input type=\"checkbox\" name=\"interests[]\" value=\"$row->id\" checked>&nbsp;&nbsp;$row->name<br>";
                        else
                          echo "<input type=\"checkbox\" name=\"interests[]\" value=\"$row->id\" >&nbsp;&nbsp;$row->name<br>";
                      }
                    }*/


									?>

								<!-- </p> -->


                <p class="place_interests">

                  <!-- <label>Select your extra Curricular Interests:</label>
                  <span class="select_interests">
                    <select name="interests[]" class="required">
                      <option value="" disabled="disabled" selected="">Select interests</option> -->

                    <label>Select your extra Curricular Interests:</label>
                      
                      <?php

                      if(Input::old('interests') == null)
                      {
                        $total = $interests->count();

                        echo "<span class=\"select_interests\">";
                        echo "<select name=\"interests[]\" class=\"required\">";
                        echo "<option value=\"\" disabled=\"disabled\" selected=\"\">Select interests</option>";
                        foreach($interests as $row)
                        {
                          echo "<option value=\"$row->id\">$row->name</option>";
                        }
                        echo "</select>";
                        echo "<span class=\"label label-success clone\" onClick=\"initializeMax($total)\">+ Add</span>";
                        echo "<span class=\"label label-danger remove\">- Remove</span>";
                        echo "</span>";
                      }
                      else
                      {
                        $interests_arr = Input::old('interests');
                        $total = $interests->count();
                        $index = count($interests_arr);

                        foreach($interests as $row)
                        {
                          if(in_array($row->id, $interests_arr))
                          {
                            echo "<span class=\"select_interests\">";
                            echo "<select name=\"interests[]\" class=\"required\">";
                            echo "<option value=\"\" disabled=\"disabled\" >Select interests</option>";
                            foreach($interests as $value)
                            {
                              if($value->id == $row->id)
                                echo "<option value=\"$value->id\" selected>$value->name</option>";
                              else
                                echo "<option value=\"$value->id\">$value->name</option>";
                            }
                            echo "</select>";
                            echo "<span class=\"label label-success clone\" onClick=\"initializeMax($total);initializeIndex($index);\">+ Add</span>";
                            echo "<span class=\"label label-danger remove\" onClick=\"initializeIndex($index);\">- Remove</span>";
                            echo "</span>";
                          }
                        }
                      }
                      ?>


                      <!--<option value="Sports">Sports</option>
                      <option value="Programming">Programming</option>
                      <option value="Arts">Arts</option>
                      <option value="Music">Music</option>-->
                    <!-- </select>
                    <span class="label label-success clone" onClick="initializeMax('<?php echo $interests->count(); ?>')">+ Add</span>
                    <span class="label label-danger remove">- Remove</span>
                  </span> -->  

                </p>

                <?php
                if(!empty(Session::get('msg')))
                {
                  echo "<span class='msg'>" . Session::get('msg') . "</span>";
                }
                else
                {
                  echo "<span class=\"msg\"></span>";
                }
                ?>
							
								<br />

								<div class="submit">
						  			<a href="javascript:void(0)" class="button-clear js-form-submit">
							  			<span>Sign me Up!</span>
							  		</a>
							  		&nbsp;&nbsp;
							  		@if(Auth::user())
                      <a href="{{ URL::route('view_students') }}">Cancel</a>
                    @else
                      <a href="{{ URL::route('login_view') }}">Cancel</a>
                    @endif
						  	</div>


							<?php Form::close() ?>
							</div>
						</div>						
					</div>
				</div>
				<div class="already-account">
					Already, have an account!
					<a href="{{ URL::route('login_view') }}">Sign In here</a>
				</div>
			</div>
		</div>
	</div>
</body>


<script>
  var arr = [];
  var index = 1;
  var flag = 0;
  function initializeMax(max_val)
  {
    max = max_val;
    // arr = $('.place_interests select.required').map(function(){
    //     v = jQuery.inArray(this.value, arr)
    //     return this.value;
    // }).get();

    // console.log( arr );
    // console.log( "===" );
    // console.log( v );
    // console.log( "===" );

    // if(v >= 0)
    // {
    //   console.log("****************");
    // }
    // else
    // {
    //   console.log("################");      
    // }

  }


  function initializeIndex(index_val)
  {
    if(flag == 0)
    {
      index = index_val;
      console.log("Index changed to: " + index);
    }
    console.log("Not Changed: " + index);
    flag++;
  }
</script>




@stop