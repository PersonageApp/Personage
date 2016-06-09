<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Werelden;
use DB;
use App\Http\Controllers\Controller;

class WereldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function BewerkWereld($verhaal, $wereld)
    {
        $wereld = Werelden::where('wereld_id', $wereld)->first();

        return view('wereld.edit' , [
            'wereld' => $wereld
        ]);
    }

     public function update($verhaal, $wereld, Request $request)
    {
        DB::table('werelden')->where('wereld_id', $wereld)->update([
            'naam' => $request['naam'],
            'beschrijving' => $request['beschrijving']
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
