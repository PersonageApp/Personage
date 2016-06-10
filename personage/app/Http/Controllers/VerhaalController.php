<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Verhalen;
use DB;
use App\Http\Controllers\Controller;

class VerhaalController extends Controller
{
    /* In deze functie word het verhaal geupdate, verhaal en naam worden geupdate en bij het versturen van het form word er een flash message meegestuurd naar de pagina waarna geredirect wordt. */    
	public function update($id, Request $request) 
    	{
    		DB::table('verhalen')->where('verhaal_id', $id)->update([
    			'verhaal' => $request['verhaal'],
    			'naam' => $request['naam']
    		]);

            flash()->success("Het verhaal '".$request->naam."' is succesvol bijgewerkt.");

    		return redirect('/');
    	}

    /* In deze functie word het verhaal opgehaald om te weergeven op de pagina van het verhaal. */ 
	public function bekijkVerhaal($id)
		{
    		$verhaal = DB::table('verhalen')->where('verhaal_id', $id)->get();
    		return view('verhaal.bekijken', [
    			'verhaal' => $verhaal
    			]);
    	}	

    /* In deze functie word het verhaal opgehaald om te weergeven in het form voor het verhaal te bewerken. */     
    public function bekijkBewerken($id)
        {
            $verhaal = DB::table('verhalen')->where('verhaal_id', $id)->get();
            return view('verhaal.edit', [
                'verhaal' => $verhaal,
                'id' => $id
            ]);
        }   
}
