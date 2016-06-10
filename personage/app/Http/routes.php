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
			return redirect('/verhalen/'.Request::get('verhaal_id').'/bekijken#wereldenToevoegen')
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

	    flash()->success("De locatie '".$locaties->naam."' is succesvol toegevoegd.");

	    return Redirect::back();
	});

	/* Locatie Bewerken */
	Route::get('wereld/{wereld}/bekijken/{locatie}/edit', 'LocatieController@BewerkLocatie');
	Route::put('wereld/{wereld}/bekijken/{locatie}/edit', 'LocatieController@update');

	/* Locatie Verwijderen */
	Route::delete('locaties/{locatie}', 'LocatieController@verwijderen');


/* Families */
	/* Familie toevoegen */	
	Route::post('/families/post', function (Request $request) {
		$validator = Validator::make(Request::all(), ['naam' => 'required|max:50','beschrijving' => 'required','geschiedenis' => 'required','verhaal_id' => 'required']);
		if ($validator->fails()) {
			return redirect('/verhalen/'.Request::get('verhaal_id').'/bekijken#familieToevoegen')
				->withInput()
				->withErrors($validator);
		}

		$families = new \App\Families;
	    $families->naam = Request::get('naam');
	    $families->beschrijving = Request::get('beschrijving');
	    $families->geschiedenis = Request::get('geschiedenis');
	    $families->verhaal_id = Request::get('verhaal_id');
	    $families->save();

	    flash()->success("De familie '".$families->naam."' is succesvol toegevoegd.");

	    return redirect('/verhalen/'.$families->verhaal_id.'/bekijken#familieOverzicht');
	});

	/* Familie Bewerken */
	Route::get('verhalen/{verhaal}/bekijken/{familie}/familie/edit', 'FamilieController@BewerkFamilie');
	Route::put('verhalen/{verhaal}/bekijken/{familie}/familie/edit', 'FamilieController@update');

	/* Familie Verwijderen */
	Route::delete('families/{familie}', 'FamilieController@verwijderen');


/* Personages */ 	
	/* Personage Toevoegen */
	Route::post('/personages/post', function (Request $request) {
		$validator = Validator::make(Request::all(), ['naam' => 'required|max:50','leeftijd' => 'required','afbeelding' => 'required','geslacht' => 'required','superkrachten' => 'required','achtergrondinformatie' => 'required','levend' => 'required','opmerkingen' => 'required']);
		if ($validator->fails()) {
			return Redirect::back() 
				->withInput()
				->withErrors($validator);
		}

		$personages = new \App\Personages;
	    $personages->naam = Request::get('naam');
	    $personages->leeftijd = Request::get('leeftijd');
	    $personages->afbeelding = Request::get('afbeelding');
	    $personages->geslacht = Request::get('geslacht');
	    $personages->superkrachten = Request::get('superkrachten');
	    $personages->achtergrondinformatie = Request::get('achtergrondinformatie');
	    $personages->levend = Request::get('levend');
	    $personages->opmerkingen = Request::get('opmerkingen');
	    $personages->familie_id = Request::get('familie_id');
	    $personages->save();

	    flash()->success("De personage '".$personages->naam."' is succesvol toegevoegd.");

	    return Redirect::back();
	});

	/* Personage Bewerken */
	Route::get('familie/{familie}/bekijken/{personage}/edit', 'PersonageController@BewerkPersonage');
	Route::put('familie/{familie}/bekijken/{personage}/edit', 'PersonageController@update');

	/* Personage Verwijderen */
	Route::delete('personage/{personage}', 'PersonageController@verwijderen');	

/* Admin /*
	/* Gebruiker Toevoegen */
	Route::post('/gebruiker/post', function (Request $request) {
		$validator = Validator::make(Request::all(), ['name' => 'required|max:255','email' => 'required|email|max:255|unique:users','password' => 'required|min:6']);
		if ($validator->fails()) {
			return Redirect::back() 
				->withInput()
				->withErrors($validator);
		}

		$gebruikers = new \App\Gebruikers;
	    $gebruikers->name = Request::get('name');
	    $gebruikers->email = Request::get('email');
	    $gebruikers->password = bcrypt(Request::get('password'));
	    $gebruikers->save();

	    flash()->success("De gebruiker '".$gebruikers->name."' is succesvol toegevoegd.");

	    return Redirect::back();
	});

	/* Gebruikers Bekijken */
	Route::get('gebruikers', 'GebruikerController@show');

	/* Gebruikers Bewerken */ 
	Route::get('gebruikers/edit/{gebruiker}', 'GebruikerController@BewerkGebruiker');
	Route::put('gebruikers/edit/{gebruiker}', 'GebruikerController@update');

	/* Gebruikers Verwijderen */
	Route::delete('gebruikers/{gebruiker}', 'GebruikerController@delete');
