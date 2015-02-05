<?php


class Student extends Eloquent {

	public function scopePopulate($query)
    {
        //return $query->where('name', 'LIKE',  'Saumya' . '%');
        //return $query->whereGender('M');
        return $query->whereName('saumya rastogi');
    }

	public function interests()
    {
        return $this->belongsToMany('Interest');
    }

	// public static $rules_for_update = array(
	// 		'name' => 'required|max:30',
	// 		'email' => 'required|max:30|email',
	// 		'dob' => 'required|date',
	// 		'address' => 'required',
	// 		'gender' => 'required'
	// );

	public static $rules_for_signup = array(
			'name' => 'required|max:30',
			'email' => 'required|max:30|email|unique:students',
			'password' => 'required|min:6',
			'confirm_password' => 'required|same:password',
			'dob' => 'required|date',
			'address' => 'required',
			'gender' => 'required'
	);

	public static $rules_for_login = array(
			'email' => 'required',
			'password' => 'required'
	);

	public static $rules_for_forgot_password = array(
			'email' => 'required|email'
	);

	public static $rules_for_change_password = array(
			'old-password' => 'required',
			'new-password' => 'required|min:6',
			'confirm-new-password' => 'required|same:new-password'
	);

	public static function update_validation($data)
	{
		$rules_for_update = array(
				'name' => 'required|max:30',
				'email' => 'required|max:30|email|unique:students,email,' . $data['id'],
				'dob' => 'required|date',
				'address' => 'required',
				'gender' => 'required'
		);
		return Validator::make($data, $rules_for_update);
	}

	public static function signup_validation($data)
	{
		return Validator::make($data, static::$rules_for_signup);
	}

	public static function login_validation($data)
	{
		return Validator::make($data, static::$rules_for_login);
	}

	public static function forgot_password_validation($data)
	{
		return Validator::make($data, static::$rules_for_forgot_password);
	}

	public static function change_password_validation($data)
	{
		return Validator::make($data, static::$rules_for_change_password);
	}

}
