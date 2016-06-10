@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">Gebruiker bewerken</div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('/gebruikers/edit/'. $gebruiker->id)}} " method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="text" class="form-control verhaal-toevoegen" value="{{ $gebruiker->name }}" name="name" required> 
                <input type="email" class="form-control verhaal-toevoegen" value="{{ $gebruiker->email }}" name="email" required>
                <input type="password" class="form-control verhaal-toevoegen" placeholder="Wachtwoord" name="password" required>
                <button type="submit" class="btn btn-primary">Gebruiker bijwerken</button>
            </form> 
        </div>
    </div>  
    </div>  
@stop