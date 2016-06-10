@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">Personage bewerken</div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('/familie/'. $personage->familie_id .'/bekijken/'. $personage->personage_id .'/edit')}} " method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $personage->naam }}" name="naam" required>
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $personage->afbeelding }}" name="afbeelding" required>
                <input type="number" class="form-control verhaal-toevoegen" value="{{ $personage->leeftijd }}" name="leeftijd" required>
                <label for="select" class="col-lg-2 control-label" style="width: 10% !important; padding-top: 11px; font-size: 14px;">Geslacht</label>
                <select name="geslacht" class="form-control verhaal-toevoegen verhaal-toevoegen2" required>
                  <option value="man">Man</option>
                  <option value="vrouw">Vrouw</option>
                </select>
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $personage->superkrachten }}" name="superkrachten" required>
                <textarea class="form-control" id="verhaal-text" name="achtergrondinformatie" required>{{ $personage->achtergrondinformatie }}</textarea>
                <label for="select" class="col-lg-2 control-label" style="width: 10% !important; padding-top: 11px; font-size: 14px;">Levend</label>
                <select name="levend" class="form-control verhaal-toevoegen verhaal-toevoegen2" required>
                  <option value="1">Levend</option>
                  <option value="0">Overleden</option>
                </select>
                <textarea class="form-control" id="verhaal-text" name="opmerkingen" required>{{ $personage->opmerkingen }}</textarea>
                <button type="submit" class="btn btn-primary">Personage bijwerken</button>
            </form> 
        </div>
    </div>  
    </div>  
@stop