<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Routes within this Route Group will run only when the user is logged in
Route::group(array('before' => 'auth'), function()
{
    
    Route::get('students', array('as'=>'view_students', 'uses'=>'StudentsController@index'));
    Route::get('students/{id}/edit', array('as'=>'edit', 'uses'=>'StudentsController@edit'));
    Route::get('delete/{id}', array('as'=>'delete', 'uses'=>'StudentsController@destroy'));
    Route::get('logout', array('as'=>'logout', 'uses'=>'StudentsController@logout'));
    Route::get('change_password_view', array('as'=>'change_password_view', 'uses'=>'StudentsController@changePasswordView'));
    Route::post('update', 'StudentsController@updateUser');
    Route::post('change_password', array('as'=>'change_password', 'uses'=>'StudentsController@changePassword'));
    Route::get('students/{id}', array('as' => 'show', 'uses' => 'StudentsController@show'))->where('id', '[0-9]+');
   

});

Route::group(array('before' => 'guest'), function()
{
	Route::get('/', array('as'=>'login_view', 'uses'=>'StudentsController@loginView'));
});



// Routes within this Route Group doesn't need Authentication to be valid
	
	Route::get('students/new', array('as'=>'new_student', 'uses'=>'StudentsController@newStudent'));
	Route::get('forgot_password_view', array('as'=>'forgot_password_view', 'uses'=>'StudentsController@forgotPasswordView'));
	Route::get('recover/{code}', array('as'=>'recover', 'uses'=>'StudentsController@getRecover'));
	Route::post('login', array('as'=>'login', 'uses'=>'StudentsController@login'));
	Route::post('students', array('as'=>'create', 'uses'=>'StudentsController@create'));
	Route::post('forgot_password', array('as'=>'forgot_password', 'uses'=>'StudentsController@forgotPassword'));



Route::get('users', function()
	{
	    return View::make('users')
	    		->with('title', "Search");
	});

Route::post('executeSearch', array('as'=>'executeSearch', 'uses'=>'StudentsController@executeSearch'));



// Get Routes
// Route::get('/', array('as'=>'login_view', 'uses'=>'StudentsController@loginView'));
// Route::get('homepage', array('as'=>'homepage', 'uses'=>'StudentsController@start'));
// Route::get('view/{id}', array('as'=>'view', 'uses'=>'StudentsController@view'));
// Route::get('sign_up', array('as'=>'sign_up', 'uses'=>'StudentsController@signUpView'));
// Route::get('delete/{id}', array('as'=>'delete', 'uses'=>'StudentsController@delete'));
// Route::get('logout', array('as'=>'logout', 'uses'=>'StudentsController@logout'));
// Route::get('forgot_password_view', array('as'=>'forgot_password_view', 'uses'=>'StudentsController@forgotPasswordView'));
// Route::get('recover/{code}', array('as'=>'recover', 'uses'=>'StudentsController@getRecover'));
// Route::get('change_password_view', array('as'=>'change_password_view', 'uses'=>'StudentsController@changePasswordView'));


// Post Routes
// Route::post('login', array('as'=>'login', 'uses'=>'StudentsController@login'));
// Route::post('update', 'StudentsController@updateUser');
// Route::post('add', array('as'=>'add', 'uses'=>'StudentsController@add'));
// Route::post('forgot_password', array('as'=>'forgot_password', 'uses'=>'StudentsController@forgotPassword'));
// Route::post('change_password', array('as'=>'change_password', 'uses'=>'StudentsController@changePassword'));




Route::resource('students', 'StudentsController');

