<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Families;
use DB;
use App\Http\Controllers\Controller;

class FamilieController extends Controller
{
    public function BewerkFamilie($verhaal, $familie)
    {
        $familie = Families::where('familie_id', $familie)->first();

        return view('familie.edit' , [
            'familie' => $familie
        ]);
    }

    public function update($verhaal, $familie, Request $request)
    {
        $verhaalid = DB::table('families')->where('familie_id', $familie)->first();
        DB::table('families')->where('familie_id', $familie)->update([
            'naam' => $request['naam'],
            'beschrijving' => $request['beschrijving'],
            'geschiedenis' => $request['geschiedenis']
            ]);

        flash()->success("De familie '".$request->naam."' is succesvol bijgewerkt.");

        return redirect('/verhalen/'.$verhaalid->verhaal_id.'/bekijken#familieOverzicht');
    }

    public function verwijderen($id) 
    {
        $verhaalid = DB::table('families')->where('familie_id', $id)->first();
        DB::table('personages')->join('families', 'personages.familie_id', '=', 'families.familie_id')->where('verhaal_id', $id)->delete();
        DB::table('families')->where('familie_id', $id)->delete();

        flash()->success("De familie is succesvol verwijderd.");

        return redirect('/verhalen/'.$verhaalid->verhaal_id.'/bekijken#familieOverzicht');
    }
}
