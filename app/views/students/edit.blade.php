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
				
			@if(Auth::user())
				<ul class="nav navbar-nav navbar-right visible-md visible-lg">
					<li>
	  				<a href="{{ URL::route('logout') }}" class="button">Logout</a>
					</li>
				</ul>
			@endif
			
	</nav>
	</div>
</header>
@stop


@section('content')


<?php 
/*if(!isset($student->id))
	{
    $new_arr = Input::get();
	}*/
?>

<?php
	/*if(!isset($student) && !isset($new_arr))
	{
	    echo "<p class='bg-danger'>Error!</p>";
	}*/
 ?>

<body id="signup">
	<div class="container animated fadeInDown">
		<div class="row header">
			<div class="col-md-12">
				<h4>Update Student Details!</h4>
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


							<?php
								if(Input::old('interests') != null)
								{
									$new_arr = Input::old();
								}
							?>

							<div class="col-md-12">
								<?php echo Form::open(array('url' => 'update')); ?>

		<p>
			<?php 
				echo Form::label('name', 'Name*');
				if(isset($student->id))
				{
					echo Form::text('name', $student->name, array('class' => 'form-control'));
				}
				else
				{
					if($errors->first('name') == null)
          {
              echo Form::text('name', 'abc1', array('class' => 'form-control'));
          }
          else
          {
              echo Form::text('name', 'abc2', array('class' => 'form-control error-border'));
          }					
				}
        echo "<span class='error-msg'>" . $errors->first('name') . "</span>";
			?>
		</p>

		<p>
			<?php 
				echo Form::label('address', 'Address*');
				if(isset($student->id))
				{
					echo Form::text('address', $student->address, array('class' => 'form-control'));
				}
				else
				{
					if($errors->first('address') == null)
          {
              echo Form::text('address', Input::get('address'), array('class' => 'form-control'));
          }
          else
          {
              echo Form::text('address', Input::get('address'), array('class' => 'form-control error-border'));
          }
				}
        echo "<span class='error-msg'>" . $errors->first('address') . "</span>";
			?>
		</p>

		<p>
			<?php 
				echo Form::label('email', 'Email*');
				if(isset($student->id))
				{
					echo Form::text('email', $student->email, array('class' => 'form-control'));
				}
				else
				{
					if($errors->first('email') == null)
          {
              echo Form::text('email', Input::get('email'), array('class' => 'form-control'));
          }
          else
          {
              echo Form::text('email', Input::get('email'), array('class' => 'form-control error-border'));
          }
				}
        echo "<span class='error-msg'>" . $errors->first('email') . "</span>";
			?>
		</p>

		<p>
			<?php 
				echo Form::label('dob', 'Date of Birth*');
				if(isset($student->id))
				{
					// Preparing Formatted Date Variables..!!
			        $converted_date = date("d-m-Y", strtotime($student->dob));

					echo Form::text('dob', $converted_date, array('class' => 'form-control'));
				}
				else
				{
					if($errors->first('dob') == null)
          {
              echo Form::text('dob', Input::get('dob'), array('class' => 'form-control'));
          }
          else
          {
              echo Form::text('dob', Input::get('dob'), array('class' => 'form-control error-border'));
          }
				}
        echo "<span class='error-msg'>" . $errors->first('dob') . "</span>";
			?>
						
		</p>

		<p>
			 <?php
				if(isset($student->id))
				{
					echo Form::hidden('id', $student->id);
				}
				else
				{
					echo Form::hidden('id', Input::get('id'));
				}
			?>
		</p>

		<p>
			<?php
			
				if(isset($student->id))
				{
					if($student->gender == "M")
					{
						echo Form::label('gender', 'Gender*');
						echo "<br>";
						echo Form::radio('gender', 'M', TRUE);
						echo "&nbsp;Male<br>";

						echo Form::radio('gender', 'F');
						echo "&nbsp;Female<br>";
					}
					else
					{
						echo Form::label('gender', 'Gender*');
						echo "<br>";
						echo Form::radio('gender', 'M');
						echo "&nbsp;Male<br>";

						echo Form::radio('gender', 'F', TRUE);
						echo "&nbsp;Female<br>";
					}
          echo "<span class='error-msg'>" . $errors->first('gender') . "</span>";
				}
				else
				{
					if(Input::get('gender') == "M")
					{
						echo Form::label('gender', 'Gender*');
						echo "<br>";
						echo Form::radio('gender', 'M', TRUE);
						echo "&nbsp;Male<br>";

						echo Form::radio('gender', 'F');
						echo "&nbsp;Female<br>";
					}
					else
					{
						echo Form::label('gender', 'Gender*');
						echo "<br>";
						echo Form::radio('gender', 'M');
						echo "&nbsp;Male<br>";

						echo Form::radio('gender', 'F', TRUE);
						echo "&nbsp;Female<br>";
					}
          echo "<span class='error-msg'>" . $errors->first('gender') . "</span>";          
				}
				
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
				
				if(isset($student->id))
				{
					if($student->year == "2015")
						$flag2015 = "selected";
					elseif ($student->year == "2016")
						$flag2016 = "selected";
					elseif ($student->year == "2017")
						$flag2017 = "selected";
					elseif ($student->year == "2018")
						$flag2018 = "selected";
					else
						$flag = "selected";
				}
				else
				{
					if(Input::get('year') == "2015")
						$flag2015 = "selected";
					elseif (Input::get('year') == "2016")
						$flag2016 = "selected";
					elseif (Input::get('year') == "2017")
						$flag2017 = "selected";
					elseif (Input::get('year') == "2018")
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


		<p class="place_interests">
			<label>Extra Curricular Interests:</label><br>

			<?php

				$str = "";

				foreach($student->interests as $interest)
				{
					$str .= $interest->id . ",";
				}

				$str = rtrim($str, ","); // Removing Trailing Comma
        $interests_arr = explode(',', $str);

			// 	foreach($interests as $row)
			// 	{
			// 		if(in_array($row->name, $str_arr))
			// 			echo "<input type=\"checkbox\" name=\"interests[]\" value=\"$row->id\" checked>&nbsp;&nbsp;$row->name<br>";
			// 		else
			// 			echo "<input type=\"checkbox\" name=\"interests[]\" value=\"$row->id\">&nbsp;&nbsp;$row->name<br>";
			// 	}

			?>

			<?php

	          if(Input::old('interests') == null)
	          {
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

		</p>

    <span class="msg"></span>

	
		<br />

		<div class="submit">
  			<a href="javascript:void(0)" class="button-clear js-form-submit">
	  			<span>Update</span>
	  		</a>
	  		&nbsp;&nbsp;
	  		<a href="{{ URL::route('view_students') }}">
	  			Cancel
	  		</a>
  		</div>


	<?php Form::close() ?>
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
















