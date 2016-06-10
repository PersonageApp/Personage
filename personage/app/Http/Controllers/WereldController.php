<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Werelden;
use DB;
use App\Http\Controllers\Controller;

class WereldController extends Controller
{
    public function BewerkWereld($verhaal, $wereld)
    {
        $wereld = Werelden::where('wereld_id', $wereld)->first();

        return view('wereld.edit' , [
            'wereld' => $wereld
        ]);
    }

    public function update($verhaal, $wereld, Request $request)
    {
        $verhaalid = DB::table('werelden')->where('wereld_id', $wereld)->first();
        DB::table('werelden')->where('wereld_id', $wereld)->update([
            'naam' => $request['naam'],
            'beschrijving' => $request['beschrijving'],
            ]);

        flash()->success("De wereld '".$request->naam."' is succesvol bijgewerkt.");

        return redirect('/verhalen/'.$verhaalid->verhaal_id.'/bekijken#wereldenOverzicht');
    }

    public function verwijderen($id) 
    {
        $verhaalid = DB::table('werelden')->where('wereld_id', $id)->first();
        DB::table('locaties')->join('werelden', 'locaties.wereld_id', '=', 'werelden.wereld_id')->where('verhaal_id', $id)->delete();
        DB::table('werelden')->where('wereld_id', $id)->delete();

        flash()->success("De wereld is succesvol verwijderd.");

        return redirect('/verhalen/'.$verhaalid->verhaal_id.'/bekijken#wereldenOverzicht');
    }
}
