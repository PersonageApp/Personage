<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Verhalen;
use DB;
use App\Http\Controllers\Controller;

class VerhaalController extends Controller
{
    public function showEditForm($id)
    	{
    		$verhaal = DB::table('verhalen')->where('verhaal_id', $id)->get();
    		return view('verhaal.schrijven', [
    			'verhaal' => $verhaal
    			]);
    	}

	public function update($id) 
	{
		$verhaal = DB::table('verhalen')->where('verhaal_id', $id)->update();

	}

	public function bekijkVerhaal($id)
		{
    		$verhaal = DB::table('verhalen')->where('verhaal_id', $id)->get();
    		return view('verhaal.bekijken', [
    			'verhaal' => $verhaal
    			]);
    	}	
}
