<?php

class StudentsController extends BaseController {


	function loginView()
	{
		return View::make('students.loginView')
				->with('title', 'Login Page');
	}

	function login()
	{
		$input = Input::all();
		$validator = Student::login_validation($input);

		if($validator->fails()) 
		{
			return Redirect::to('/')
			    ->with('msg_tag', 'danger')
			    ->with('message', 'Login Failed!')
			    ->withErrors($validator);
		}
		else
		{
			$credentials = array('email' => $input['email'], 'password' => $input['password']);

			if(Auth::attempt($credentials))
			{
				$student = Student::where('email', '=', $input['email'])->firstOrFail();
				$msg = "Welcome, " . $student->name . "!";

				return Redirect::route('view_students')
						->with('msg_tag', 'success')
						->with('message', $msg);
			}
			else
			{
				return Redirect::route('login_view')
						->with('msg_tag', 'danger')
					  ->with('message', 'Login Failed, please check your credentials!');
			}
		}

	}

	function executeSearch()
	{
		$limit = 5; // For Pagination
		$keywords = Input::get('keywords');

		$students = Student::where("name","like","%".$keywords."%")
					->orWhere("email","like","%".$keywords."%")
					->orWhere("address","like","%".$keywords."%")
					->paginate($limit);

		$count_total_students = Student::where("name","like","%".$keywords."%")
					->orWhere("email","like","%".$keywords."%")
					->orWhere("address","like","%".$keywords."%")
					->get();

		return View::make('students.executeSearch')
				->with('limit', $limit)
				->with('count_total_students', $count_total_students)
				->with('students', $students);
	}

	function index()
	{
		$total_students = Student::all();

		if(Auth::user())
		{
			$limit = 5;
			$students = Student::paginate($limit);			

			return View::make('students.index')
				->with('students', $students)
				->with('total_students', $total_students)
				->with('limit', $limit)
				->with('title', 'Welcome Page');
		}
		else
		{
			return Redirect::route('login_view')
						->with('msg_tag', 'danger')
					    ->with('message', "You're not Logged In, Please Login to continue!");
		}
		
	}

	function edit($id)
	{
		$title = "Update Student";
		$student = Student::find($id); //single
		$interests = Interest::all();

		return View::make('students.edit')
			->with('student', $student)
			->with('interests', $interests)
			->with('title', $title);
	}

	function newStudent()
	{

		$title = "Add Student";

		$interests = Interest::all();

		return View::make('students.newStudent')
			->with('interests', $interests)
			->with('title', $title);
	}

	function show($id)
	{
		$student = Student::find($id);
		$interests = "";

		$columns = Schema::getColumnListing('students');

		foreach($student->interests as $interest)
		{
      		$interests_arr[] = $interest->name;
		}

		$title = $student->name . "'s Profile";

		return View::make('students.show')
				->with('interests_arr', $interests_arr)
				->with('columns', $columns)
				->with('student', $student)
				->with('title', $title);
	}

	function destroy($id)
	{
		if(Auth::user())
		{
			$student = Student::find($id);

			$interests_arr = Input::get('interests');					
			$student_tag = Student::find($student->id);
			
			$student->interests()->detach();

			if($student->delete())
			{
				return Redirect::route('view_students')
						->with('msg_tag', 'success')
						->with('message', 'Student Deleted Successfully!');
			}

			return Redirect::route('view_students')
				->with('msg_tag', 'danger')
				->with('message', 'Student cannot be Deleted!');
		}
		else
		{
			return Redirect::route('login_view')
						->with('msg_tag', 'danger')
					  ->with('message', "You're not Logged In, Please Login to continue!");
		}
		
	}

	function updateUser()
	{
		// Code for Updating the Data..!!
	
		$id = Input::get('id');
		$validator = Student::update_validation(Input::get());

		if($validator->fails()) 
		{
			return Redirect::route('edit', $id)
						->withErrors($validator)
						->withInput(Input::get());
		}
		else
		{

      if(Input::get('interests') != null)
      {
        $interests_rows = Interest::count();
        $interests_arr = Input::get('interests');

        // Checking for Interests if they are more than their expected limit
        if(count($interests_arr) > $interests_rows)
        {
          return Redirect::route('new_student')
              ->with('msg', "Interests can't be more than " . $interests_rows . "!")
              ->withInput(Input::except('password', 'confirm_password'));
        }

        // Checking Interests for duplicate values
        function array_is_unique($array)
        {
          return array_unique($array) == $array;
        }
        
        $a = array_is_unique($interests_arr) ? "1" : "0";

        if($a == 0)
        {
          return Redirect::route('new_student')
            ->with('msg', "Interests can't be same!")
            ->withInput(Input::except('password', 'confirm_password'));
        }
        
      }


      // Preparing interests Variable & Attaching them to Pivot Table!!
      if(Input::get('interests') != null)
      {
				$interests_arr = Input::get('interests');					
				$student = Student::find($id);

				$student->interests()->sync($interests_arr);
      }
      
      // Preparing Formatted Date Variables..!!
      $converted_date = date("Y-m-d", strtotime(Input::get('dob')));

      $student = Student::find($id);
      $student->name =  Input::get('name');
      $student->email = Input::get('email');
      $student->dob = $converted_date;
      $student->address = Input::get('address');
      $student->year = Input::get('year');
      $student->save();

      return Redirect::route('edit', $id)
            ->with('msg_tag', 'success')
            ->with('message', 'Student Record Updated Successfully!');
		}
	}

	
  function store()
	{
		$title = "Sign Up!";
		$validator = Student::signup_validation(Input::get());

		if($validator->fails()) 
		{
			return Redirect::route('new_student')
					->withErrors($validator)
					->withInput(Input::except('password', 'confirm_password'));
		}
		else
		{
      if(Input::get('interests') != null)
      {
        $interests_rows = Interest::count();
        $interests_arr = Input::get('interests');

        // Checking for Interests if they are more than their expected limit
        if(count($interests_arr) > $interests_rows)
        {
          return Redirect::route('new_student')
              ->with('msg', "Interests can't be more than " . $interests_rows . "!")
              ->withInput(Input::except('password', 'confirm_password'));
        }

        // Checking Interests for duplicate values
        function array_is_unique($array)
        {
          return array_unique($array) == $array;
        }
        
        $a = array_is_unique($interests_arr) ? "1" : "0";

        if($a == 0)
        {
          return Redirect::route('new_student')
            ->with('msg', "Interests can't be same!")
            ->withInput(Input::except('password', 'confirm_password'));
        }
        
      }

      // Preparing Password..!!
      $hashed_password = Hash::make(Input::get('password'));            

      // Preparing Formatted Date Variables..!!
      $converted_date = date("Y-m-d", strtotime(Input::get('dob')));

      $student = new Student;
      $student->name =  Input::get('name');
      $student->email = Input::get('email');
      $student->password = $hashed_password;
      $student->dob = $converted_date;
      $student->address = Input::get('address');
      $student->gender = Input::get('gender');
      if(Input::get('year') != null)
      {
      	$student->year = Input::get('year');
      }
      
      if($student->save())
      {
      	if(Input::get('interests') != null) //if (!empty(Input::get....))
      	{
        	 $interests_arr = Input::get('interests');					
		       $student_tag = Student::find($student->id);

		       $student_tag->interests()->sync($interests_arr);
	      }

        Mail::send('emails.auth.welcome', array('url' => URL::route('view_students'), 'name' => $student->name), function($message) use ($student)
				{
				    $message->to($student->email, $student->name)->subject('Welcome! - Localhost');
				});

        $credentials = array('email' => $student->email, 'password' => $student->password);

        if(Auth::attempt($credentials))
        {
          $msg = "Welcome, " . $student->name . "!";

          return Redirect::route('view_students')
              ->with('msg_tag', 'success')
              ->with('message', $msg);
        }
        else
        {
          return Redirect::route('login_view')
              ->with('msg_tag', 'success')
              ->with('message', "You've been successfully signed up!");
        }

      /*if(!Auth::check())
      {
         $credentials = array(
             'email' => $student->email,
             'password' => $student->password
         );

		     if(Auth::attempt($credentials))
		     {
			      return Redirect::route('view_students')
          			   ->with('msg-tag', 'success')
					         ->with('message', 'Welcome, your Account has been created Successfully!');
		     }
	    }*/
      }
		}
		
	}

	function forgotPassword()
	{
		$validator = Student::forgot_password_validation(Input::get());

		if($validator->fails()) 
		{
			return Redirect::route('forgot_password_view')
					->withErrors($validator);
		}
		else
		{

			$email = Input::get('email');
			
			try
			{
				$student = Student::where('email', '=', $email)->firstOrFail();
			}
			catch(Exception $e)
			{
				return Redirect::route('login_view')
						->with('msg_tag', 'failed')
						->with('message', $e->getMessage());
			}

			//$randomString = rand(10);
			$code = str_random(60);
			$password = str_random(10);

			$student->code = $code;
			$student->password_temp = Hash::make($password);

			if($student->save())
			{
				try
				{
					Mail::send('emails.auth.recover', array('url' => URL::route('recover', $code), 'name' => $student->name, 'password' => $password), function($message) use ($student)
					{
					    $message->to($student->email, $student->name)->subject('Your new Password! - Localhost');
					});
				}
				catch(Exception $e)
				{
					return Redirect::route('login_view')
						->with('msg_tag', 'failed')
						->with('message', $e->getMessage());
				}

				return Redirect::route('login_view')
						->with('msg_tag', 'success')
						->with('message', 'Email Sent, Check your Email ID to reset your Password');
			}
		}
	}

	public function getRecover($code)
	{
		$student = Student::where('code', '=', $code)
						->where('password_temp', '!=', '');
		
		if($student->count())
		{
			$student = $student->first();

			$student->password = $student->password_temp;
			$student->password_temp = '';
			$student->code = '';

			if($student->save())
			{
				return Redirect::route('login_view')
					->with('msg_tag', 'success')
					->with('message', 'Your Account has been recovered, Now you can sign in with your new password!');
			}
		}

		return Redirect::route('login_view')
					->with('msg_tag', 'error')
					->with('message', 'Could not recover your account.');
	}

	function forgotPasswordView()
	{
		$title = "Forgot Password";

		return View::make('students.forgotPasswordView')
					->with('title', $title);
	}

	function changePasswordView()
	{
		$title = "Change Password!";

		return View::make('students.changePasswordView')
					->with('title', $title);
	}

	function changePassword()
	{
		$validator = Student::change_password_validation(Input::get());

		if($validator->fails()) 
		{
			return Redirect::route('change_password_view')
			           ->withErrors($validator);
		}
		else
		{
			$student = Student::find(Auth::user()->id);
			$old_password = Input::get('old-password');
			$password = Input::get('new-password');

			if(Hash::check($old_password, $student->password))
			{
				$student->password = Hash::make($password);

				if($student->save())
				{
					return Redirect::route('view_students')
							->with('msg_tag', 'success')
						  ->with('message', 'Your Password has been changed Successfully!');
				}
			}
			else
			{
				return Redirect::route('change_password_view')
							->with('msg-tag', 'failed')
			    			->with('message', "Old Password doesn't match!");
			}
		}
	}

	function logout()
	{
		Auth::logout();
		return Redirect::route('login_view')
				->with('msg_tag', 'success')
				->with('message', "You've been successfully logged out!");
	}
	
}
