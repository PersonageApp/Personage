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
								<select class="form-control" name="verhaal_id">
  									<option value="1">1</option>
								</select><br>
								<input type="text" name="naam" class="form-control verhaal-toevoegen" placeholder="Naam">
			 					<textarea class="form-control" id="verhaal-text" name="beschrijving" placeholder="Beschrijving"></textarea>
								<button type="submit" class="btn btn-primary">Voeg wereld toe</button>
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection
