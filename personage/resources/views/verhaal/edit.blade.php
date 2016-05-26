@extends('layouts.app')

@section('content')
	<h1>Edit het verhaal</h1>
	{{ $verhaal[0]->naam }}
	{{ $verhaal[0]->verhaal }}
@stop