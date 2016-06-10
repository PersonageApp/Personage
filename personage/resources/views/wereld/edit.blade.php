@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">Wereld bewerken</div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('/verhalen/'. $wereld->verhaal_id .'/bekijken/'. $wereld->wereld_id .'/edit')}} " method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $wereld->naam }}" name="naam">
                <textarea class="form-control" id="verhaal-text" name="beschrijving">{{ $wereld->beschrijving }}</textarea>
                <button type="submit" class="btn btn-primary">Wereld bijwerken</button>
            </form> 
        </div>
    </div>  
    </div>  
@stop