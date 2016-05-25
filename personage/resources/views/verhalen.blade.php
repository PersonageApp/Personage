@extends('layouts.app')

@section('content')
	<div class="container">
		@include('common.errors')
		<form action="{{ url('verhalen/post') }}" method="POST">
			{{ csrf_field() }}
			<input type="text" name="naam" id="task-name">
			<input type="text" name="verhaal" id="task-name">
			<button type="submit">Add Verhaal</button>
		</form>	
	</div>
@endsection
