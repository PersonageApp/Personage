@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Verhaal toevoegen</div>
        <div class="panel-body">
        @include('common.errors')
          <form action="{{ url('verhalen/post') }}" method="POST">
          {{ csrf_field() }}
            <input type="text" class="form-control verhaal-toevoegen" name="naam" placeholder="Naam">
            <textarea class="form-control" id="verhaal-text" name="verhaal" placeholder="Verhaal"></textarea>
            <button type="submit" class="btn btn-primary">Voeg verhaal toe</button>
          </form> 
        </div>
      </div>
    </div> 
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Bestaande verhalen (<?php echo $test = DB::table('verhalen')->where('id', Auth::id())->count(); ?> totaal)</div>    
        <div class="panel-body">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Naam verhaal</th>
                <th>Bekijken</th>
                <th>Bewerken</th>
                <th>Verwijderen</th>               
              </tr>
            </thead>
            <tbody>
              <?php DB::table('verhalen')->orderBy('verhaal_id')->where('id', Auth::id())->chunk(100, function($users) { $i =0; foreach ($users as $user) { $i++; ?>
                    <tr class="verhaal-tabel"><td class="tabel-kolom-count"><?php echo $i; ?></td><td class="tabel-kolom"><?php echo $user->naam; ?></td>
                    <td><a class="button-test btn btn-primary" href="{{ url('verhalen/'.$user->verhaal_id .'/bekijken') }}"><i class="fa fa-edit"></i> Bewerken</a></td>
                     <td><a class="button-test btn btn-primary" href="{{ url('verhalen/'.$user->verhaal_id .'/edit') }}"><i class="fa fa-edit"></i> Schrijven</a></td>
                    <td>

                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"><i class="fa fa-trash"></i> Verwijderen</button>
                    </td>
                    <!-- Modal -->
                    <div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                      <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Verwijderen</h4>
                          </div>
                          <div class="modal-body">
                            <p>Weet u zeker dat u het verhaal <strong><?php echo $user->naam; ?></strong> wilt verwijderen?<br> U verwijdert hiermee alle gegevens in het verhaal.</p>
                          </div>
                          <div class="modal-footer">
                            <form action="{{ url('verhalen/'.$user->verhaal_id) }}" method="POST">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button type="submit" class="btn btn-danger">Verwijder</button>
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>           
            </tbody><?php }}); ?>   
          </table> 
        </div>
      </div>              
    </div>
  </div>
</div>
                         
@endsection
