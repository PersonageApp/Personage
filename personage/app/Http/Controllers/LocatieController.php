<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Locaties;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class LocatieController extends Controller
{
    public function BewerkLocatie($wereld, $locatie)
    {
        $locatie = Locaties::where('locatie_id', $locatie)->first();

        return view('locatie.edit' , [
            'locatie' => $locatie
        ]);
    }

     public function update($wereld, $locatie, Request $request)
    {
        DB::table('locaties')->where('locatie_id', $locatie)->update([
            'naam' => $request['naam'],
            'afbeelding' => $request['afbeelding'],
            'beschrijving' => $request['beschrijving'],
            ]);

        flash()->success("De locatie ".$request['naam']." is succesvol gewijzigd.");

        return redirect('');
    }

    public function verwijderen($locatie)
    {
        DB::table('locaties')->where('locatie_id', $locatie)->delete();

        flash()->success("De locatie is succesvol verwijderd.");

        return Redirect::back();
    }
}
