<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Locaties;
use DB;
use App\Http\Controllers\Controller;

class LocatieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'wereld_id' => $request['wereld_id']
            ]);

        return redirect('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
