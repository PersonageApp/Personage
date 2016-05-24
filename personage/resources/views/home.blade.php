@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Voeg uw verhaal toe</div>

                <div class="panel-body">
                <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>naam</th>
      <th>verhaal</th>
    </tr>
  </thead>
  <tbody>
                    <?php DB::table('verhalen')->orderBy('verhaal_id')->chunk(100, function($users) {
    foreach ($users as $user) {
        echo '
    <tr>
      <td>'; echo $user->verhaal_id; echo'</td>
      <td>'; echo $user->naam; echo'</td>
      <td>'; echo $user->verhaal; echo'</td>
    </tr>';
    }
}); ?></tbody></table>
                    <form action="#">
                        <input type="text" class="form-control">
                        <input type="submit" class="btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
