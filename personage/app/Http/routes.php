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

Route::get('/werelden', function() {
	return view('werelden');
});

Route::get('/werelden/succes', function() {
	return view('wereldToegevoegd');
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
    $verhalen->id = Auth::user()->id;
    $verhalen->save();

    return redirect('/');
});

Route::post('/werelden/post', function (Request $request) {
	$validator = Validator::make(Request::all(), ['naam' => 'required|max:50','beschrijving' => 'required','verhaal_id' => 'required']);
	if ($validator->fails()) {
		return Redirect::back() 
			->withInput()
			->withErrors($validator);
	}

	$werelden = new \App\Werelden;
    $werelden->naam = Request::get('naam');
    $werelden->beschrijving = Request::get('beschrijving');
    $werelden->verhaal_id = Request::get('verhaal_id');
    $werelden->save();

    return redirect('/verhalen/'.$werelden->verhaal_id.'/bekijken');
});

Route::delete('verhalen/{verhaal}', function ($id) {
	DB::table('werelden')->where('verhaal_id', $id)->delete();
	DB::table('verhalen')->where('verhaal_id', $id)->delete();
    return redirect('/');
});

Route::delete('werelden/{wereld}/', function ($id) {
	DB::table('werelden')->where('wereld_id', $id)->delete();
    return Redirect::back();
});

Route::get('verhalen/{verhaal}/edit', 'VerhaalController@bekijkBewerken');
Route::post('verhalen/{verhaal}/edit', 'VerhaalController@update');

Route::get('verhalen/{verhaal}/bekijken', 'VerhaalController@bekijkVerhaal');