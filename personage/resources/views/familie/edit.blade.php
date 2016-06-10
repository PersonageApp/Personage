@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">Familie bewerken</div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('/verhalen/'. $familie->verhaal_id .'/bekijken/'. $familie->familie_id .'/familie/edit')}} " method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $familie->naam }}" name="naam">
                <textarea class="form-control" id="verhaal-text" name="beschrijving">{{ $familie->beschrijving }}</textarea>
                <textarea class="form-control" id="verhaal-text" name="geschiedenis">{{ $familie->geschiedenis }}</textarea>
                <button type="submit" class="btn btn-primary">Familie bijwerken</button>
            </form> 
        </div>
    </div>  
    </div>  
@stop