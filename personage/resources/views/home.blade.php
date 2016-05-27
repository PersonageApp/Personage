@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">Verhaal toevoegen?</div>
                <div class="panel-body">
                  @include('common.errors')
                    <form action="{{ url('verhalen/post') }}" method="POST">
                      {{ csrf_field() }}
                      <input type="text" class="form-control verhaal-toevoegen" name="naam">
                      <textarea class="form-control" id="verhaal-text" name="verhaal"></textarea>
                      <button type="submit" class="btn btn-primary">Voeg verhaal toe</button>
                    </form> 
                </div>
            </div>
        </div> 
        <div class="col-md-12">
         <div class="panel panel-default">
          <div class="panel-heading">Bestaande verhalen</div>    
            <div class="panel-body">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>naam</th>
                    <th>verhaal</th>
                  </tr>
                </thead>
              <tbody>

              <?php DB::table('verhalen')->orderBy('verhaal_id')->chunk(100, function($users) {
                $i =0;
                foreach ($users as $user) {
                  $i++;
                  echo '
                    <tr>
                      <td class="tabel-kolom">'; echo $i; echo'</td>
                      <td class="tabel-kolom">'; echo $user->naam; echo'</td>
                      <td class="tabel-kolom">'; echo $user->verhaal; echo'</td>
                      <td>';?>
                        <form action="{{ url('verhalen/'.$user->verhaal_id .'/edit') }}" method="GET">
                          {{ csrf_field() }}
                          {{ method_field('PUT') }}
                          <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Bewerken
                          </button>
                        </form></td><td>
                        <form action="{{ url('verhalen/'.$user->verhaal_id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">
                              <i class="fa fa-trash"></i> Verwijderen
                            </button>
                        </form>
                      </td>
                    </tr>
                  <?php }
                }); ?></tbody></table> 

                </div>
            </div>
        </div>
    </div>
</div>
        </div>  
        
  
@endsection
