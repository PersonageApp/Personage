@extends('layouts.app')

@section('content')
	<div class="container">
	<h1>Bewerk de locatie</h1>
	<div class="panel panel-default">
        <div class="panel-heading">Locatie bewerken?</div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('/verhalen/'. $wereld->verhaal_id .'/bekijken/'. $locatie->locatie_id .'/editt')}} " method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $wereld->naam }}" name="naam">
                <textarea class="form-control" id="verhaal-text" name="beschrijving">{{ $wereld->beschrijving }}</textarea>
                <button type="submit" class="btn btn-primary">Verhaal bijwerken</button>
            </form> 
        </div>
    </div>  
    </div>  
@stop