@extends('layouts.app')

@section('content')
	<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Wereld toevoegen</div>
                <div class="panel-body">
		@include('common.errors')
		<form action="{{ url('werelden/post') }}" method="POST">
			{{ csrf_field() }}
			<input type="text" name="naam" class="form-control verhaal-toevoegen">
			 <textarea class="form-control" id="verhaal-text" name="beschrijving"></textarea>
			<button type="submit" class="btn btn-primary">Voeg wereld toe</button>
		</form>	
	</div>
	</div>
	</div>
	</div>
	</div>


@endsection
