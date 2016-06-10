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

/* Loginsysteem */ 
Route::auth();

/* Homepagina */
Route::get('/', 'HomeController@index');

/* Verhalen */
	/* Verhaal Toevoegen */
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

	    flash()->success("Het verhaal '".$verhalen->naam."' is succesvol toegevoegd.");

	    return redirect('/');
	});

	/* Verhaal Bekijken */
	Route::get('verhalen/{verhaal}/bekijken', 'VerhaalController@bekijkVerhaal');

	/* Verhaal Bewerken */
	Route::get('verhalen/{verhaal}/edit', 'VerhaalController@bekijkBewerken');
	Route::put('verhalen/{verhaal}/edit', 'VerhaalController@update');

	/* Verhaal Verwijderen */
	Route::delete('verhalen/{verhaal}', function ($id) {
		DB::table('locaties')->join('werelden', 'locaties.wereld_id', '=', 'werelden.wereld_id')->where('verhaal_id', $id)->delete();
		DB::table('werelden')->where('verhaal_id', $id)->delete();
		DB::table('verhalen')->where('verhaal_id', $id)->delete();

		flash()->success("Het verhaal is succesvol verwijderd.");

	    return redirect('/');
	});

/* Werelden */ 	
	/* Wereld Toevoegen */
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

	    flash()->success("De wereld '".$werelden->naam."' is succesvol toegevoegd.");

	    return redirect('/verhalen/'.$werelden->verhaal_id.'/bekijken#wereldenOverzicht');
	});

	/* Wereld Bewerken */
	Route::get('verhalen/{verhaal}/bekijken/{wereld}/edit', 'WereldController@BewerkWereld');
	Route::put('verhalen/{verhaal}/bekijken/{wereld}/edit', 'WereldController@update');

	/* Wereld Verwijderen */
	Route::delete('werelden/{wereld}', 'WereldController@verwijderen');

/* Locaties */
	/* Locatie Toevoegen */
	Route::post('/locaties/post', function (Request $request) {
		$validator = Validator::make(Request::all(), ['naam' => 'required|max:50','beschrijving' => 'required','wereld_id' => 'required','afbeelding' => 'required']);
		if ($validator->fails()) {
			return Redirect::back() 
				->withInput()
				->withErrors($validator);
		}

		$locaties = new \App\Locaties;
	    $locaties->naam = Request::get('naam');
	    $locaties->beschrijving = Request::get('beschrijving');
	    $locaties->wereld_id = Request::get('wereld_id');
	    $locaties->afbeelding = Request::get('afbeelding');
	    $locaties->save();
	    $verhaalid = DB::table('werelden')->join('locaties', 'werelden.wereld_id', '=', 'locaties.wereld_id')->where('wereld_id', $locaties->wereld_id)->first();

	    flash()->success("De locatie '".$locaties->naam."' is succesvol toegevoegd.");

	    return redirect('/verhalen/'.$verhaalid.'/bekijken#wereldenOverzicht');
	});

	/* Wereld Bewerken */
	Route::get('verhalen/{verhaal}/bekijken/{wereld}/edit', 'WereldController@BewerkWereld');
	Route::put('verhalen/{verhaal}/bekijken/{wereld}/edit', 'WereldController@update');

	/* Wereld Verwijderen */
	Route::delete('werelden/{wereld}', 'WereldController@verwijderen');



/* Families */
	/* Familie toevoegen */	
	Route::post('/families/post', function (Request $request) {
		$validator = Validator::make(Request::all(), ['naam' => 'required|max:50','beschrijving' => 'required','geschiedenis' => 'required','verhaal_id' => 'required']);
		if ($validator->fails()) {
			return Redirect::back() 
				->withInput()
				->withErrors($validator);
		}

		$families = new \App\Families;
	    $families->naam = Request::get('naam');
	    $families->beschrijving = Request::get('beschrijving');
	    $families->geschiedenis = Request::get('geschiedenis');
	    $families->verhaal_id = Request::get('verhaal_id');
	    $families->save();

	    return redirect('/verhalen/'.$families->verhaal_id.'/bekijken');
	});

/* Locaties */
	/* Locatie Verwijderen */
	Route::delete('werelden/{locatie}/', function ($id) {
		DB::table('locaties')->join('werelden', 'locaties.wereld_id', '=', 'werelden.wereld_id')->where('verhaal_id', $id)->delete();
	    return Redirect::back();
	});









Route::get('verhalen/{verhaal}/bekijken/{locatie}/editt', 'LocatieController@BewerkLocatie');
Route::put('verhalen/{verhaal}/bekijken/{locatie}/editt', 'LocatieController@update');
