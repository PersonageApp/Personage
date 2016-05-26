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
      <td>';?>
      <form action="{{ url('task/'.$task->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash"></i> Delete
            </button>
        </form>
    </td>
    </tr>
    <?php }
}); ?></tbody></table> 
                    <div class="container">
    @include('common.errors')
    <form action="{{ url('verhalen/post') }}" method="POST">
      {{ csrf_field() }}

      <input type="text" name="naam" id="task-name">
      <input type="text" name="verhaal" id="task-name">
      <button type="submit">Add Verhaal</button>
    </form> 
  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
