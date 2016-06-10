@extends('layouts.app')
 
@section('content')
<div class="container">
  @if (Auth::user()->role == 1)
    @if (Session::has('flash_notification.message'))
      <div class="alert alert-{{ Session::get('flash_notification.level') }}">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

          {{ Session::get('flash_notification.message') }}
      </div>
    @endif
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Gebruiker toevoegen</div>
          <div class="panel-body">
          @include('common.errors')
            <form action="{{ url('gebruiker/post') }}" method="POST">
            {{ csrf_field() }}
              <input type="text" class="form-control verhaal-toevoegen" name="name" placeholder="Naam" required>
              <input type="email" class="form-control verhaal-toevoegen" name="email" placeholder="E-mailadres" required>
              <input type="password" class="form-control verhaal-toevoegen" name="password" placeholder="Wachtwoord" required>
              <button type="submit" class="btn btn-primary">Voeg gebruiker toe</button>
            </form> 
          </div>
        </div>
      </div> 
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Bestaande gebruikers (<?php echo $test = DB::table('users')->count(); ?> totaal)</div>    
          <div class="panel-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Naam gebruiker</th>
                  <th>Bewerken</th>
                  <th>Verwijderen</th>               
                </tr>
              </thead>
              <tbody>
                <?php DB::table('users')->orderBy('id')->chunk(100, function($users) { $i =0; foreach ($users as $user) { $i++; ?>
                      <tr class="verhaal-tabel"><td class="tabel-kolom-count"><?php echo $i; ?></td><td class="tabel-kolom"><?php echo $user->name; ?></td>
                      <td><a class="button-test btn btn-primary" href="{{ url('gebruikers/edit/'.$user->id) }}"><i class="fa fa-edit"></i> Bewerken</a></td>
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
                              <p>Weet u zeker dat u het verhaal <strong><?php echo $user->name; ?></strong> wilt verwijderen?<br> U verwijdert hiermee alle gegevens in het verhaal.</p>
                            </div>
                            <div class="modal-footer">
                              <form action="{{ url('gebruikers/'.$user->id) }}" method="POST">
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
  @else 
    <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Geen Admin</div>
          <div class="panel-body">Je bent geen administrator.</div>
         </div>
        </div>  
 @endif    

@endsection
