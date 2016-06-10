@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">Locatie bewerken</div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('/wereld/'. $locatie->wereld_id .'/bekijken/'. $locatie->locatie_id .'/edit')}} " method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $locatie->naam }}" name="naam" required>
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $locatie->afbeelding }}" name="afbeelding" required>
                <textarea class="form-control" id="verhaal-text" name="beschrijving" required>{{ $locatie->beschrijving }}</textarea>
                <button type="submit" class="btn btn-primary">Locatie bijwerken</button>
            </form> 
        </div>
    </div>  
    </div>  
@stop