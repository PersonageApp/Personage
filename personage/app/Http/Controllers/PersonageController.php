<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Personages;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PersonageController extends Controller
{
    public function BewerkPersonage($familie, $personage)
    {
        $personage = Personages::where('personage_id', $personage)->first();

        return view('personage.edit' , [
            'personage' => $personage
        ]);
    }

     public function update($familie, $personage, Request $request)
    {
        DB::table('personages')->where('personage_id', $personage)->update([
            'naam' => $request['naam'],
            'afbeelding' => $request['afbeelding'],
            'leeftijd' => $request['leeftijd'],
            'geslacht' => $request['geslacht'],
            'superkrachten' => $request['superkrachten'],
            'achtergrondinformatie' => $request['achtergrondinformatie'],
            'levend' => $request['levend'],
            'opmerkingen' => $request['opmerkingen']
            ]);

        flash()->success("De personage ".$request['naam']." is succesvol gewijzigd.");

        return redirect('');
    }

    public function verwijderen($personage)
    {
        DB::table('personages')->where('personage_id', $personage)->delete();

        flash()->success("De personage is succesvol verwijderd.");

        return Redirect::back();
    }
}
