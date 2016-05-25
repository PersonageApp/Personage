<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the ntroller to call when that URI is requested.
|
*/




Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/verhalen', function() {
	return view('verhalen');
});

Route::post('/verhalen/post', function (Request $request) {
	$validator = Validator::make(Request::all(), ['naam' => 'required|max:50','verhaal' => 'required']);
	if ($validator->fails()) {
		return redirect('/')
			->withInput()
			->withErrors($validator);
	}

	$verhalen = new \App\Verhalen;
    $verhalen->naam = Request::get('naam');
    $verhalen->verhaal = Request::get('verhaal');
    $verhalen->save();

    return redirect('/');
});

Route::delete('/verhalen/{verhalen}', function (Verhalen $verhalen) {

});