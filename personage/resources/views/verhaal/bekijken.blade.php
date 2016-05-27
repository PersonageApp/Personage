@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Bekijk het verhaal</h1>
    <div class="panel panel-default">
        <div class="panel-heading">Verhaal schrijven?</div>
        <div class="panel-body">
            <h2>{{ $verhaal[0]->naam }}</h2> 
            <p>{{ $verhaal[0]->verhaal}}</p>
        </div>
    </div>  
    </div>  
@stop