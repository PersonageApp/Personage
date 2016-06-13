<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Gebruikers;
use DB;
use App\Http\Controllers\Controller;

class GebruikerController extends Controller
{
    public function show()
        {
            $gebruikers = DB::table('users')->get();
            return view('gebruikers.bekijken', [
                'gebruikers' => $gebruikers
                ]);
        }   

    public function delete($gebruiker)
    {
        DB::table('users')->where('id', $gebruiker)->delete();

        flash()->success("De gebruiker is succesvol verwijderd.");

        return redirect('/gebruikers');
    }    

    public function update($gebruiker, Request $request)
    {
        DB::table('users')->where('id', $gebruiker)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
            ]);

        flash()->success("De gebruiker '".$request->name."' is succesvol bijgewerkt.");

        return redirect('/gebruikers');
    }

    public function BewerkGebruiker($gebruiker)
    {
        $gebruiker = Gebruikers::where('id', $gebruiker)->first();

        return view('gebruikers.edit' , [
            'gebruiker' => $gebruiker
        ]);
    }
}
