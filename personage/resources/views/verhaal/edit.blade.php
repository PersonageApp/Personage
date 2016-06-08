@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">Verhaal bewerken</div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('verhalen/' . $id . '/edit') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $verhaal[0]->naam }}" name="naam">
                <textarea class="form-control" id="verhaal-text" name="verhaal">{{ $verhaal[0]->verhaal}}</textarea>
                <button type="submit" class="btn btn-primary">Verhaal bijwerken</button>
            </form> 
        </div>
    </div>  
    </div>  
@stop