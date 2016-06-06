@extends('layouts.app')

@section('content')
    <!-- container -->
    <div class="container">

        <!-- tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#verhaal" data-toggle="tab" aria-expanded="true">Verhaal</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    Werelden <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=""><a href="#wereldenOverzicht" data-toggle="tab" aria-expanded="false">Overzicht</a></li>
                    <li class=""><a href="#wereldenToevoegen" data-toggle="tab" aria-expanded="true">Toevoegen</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    Locaties <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=""><a href="#locatieOverzicht" data-toggle="tab" aria-expanded="false">Overzicht</a></li>
                    <li class=""><a href="#locatieToevoegen" data-toggle="tab" aria-expanded="true">Toevoegen</a></li>
                </ul>
            </li>
            <li class="gaterug"><a href="{{ url('/') }}" >Ga terug</a></li>
        </ul>
        <!-- tabs -->

        <!-- content -->
        <div id="myTabContent verhalentab" class="tab-content">

            <!-- verhaalpagina -->
            <div class="tab-pane fade active in" id="verhaal">
                <div class="panel panel-default">
                    <div class="panel-heading">Het verhaal <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        <h2>{{ $verhaal[0]->naam }}</h2> 
                        <p>{{ $verhaal[0]->verhaal}}</p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">De werelden</p></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="5%">#</th>
                                <th width="15%">Naam wereld</th>
                                <th width="80%">Beschrijving</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php DB::table('werelden')->orderBy('wereld_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($werelden) {
                                    $i =0; foreach ($werelden as $wereld) { $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $wereld->naam }}</td>
                                            <td>{{ $wereld->beschrijving }}</td>
                                        </tr> 
                                <?php }}); ?>   
                            </tbody>
                        </table>
                    </div>
                </div>   
            </div>
            <!-- verhaalpagina -->

            <!-- wereldoverzicht -->
            <div class="tab-pane fade" id="wereldenOverzicht">
                <div class="panel panel-default">
                    <div class="panel-heading">Wereld overzicht <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="5%">#</th>
                                <th width="15%">Naam wereld</th>
                                <th width="60%">Beschrijving</th>
                                <th width="10%">Bewerken</th> 
                                <th width="10%">Verwijderen</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php DB::table('werelden')->orderBy('wereld_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($werelden) {
                                    $i =0; foreach ($werelden as $wereld) { $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $wereld->naam }}</td>
                                            <td>{{ $wereld->beschrijving }}</td>
                                            <td><button class="btn btn-primary"><i class="fa fa-edit"> </i> Bewerken</button></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i> Verwijderen</button>
                                            </td>
                                            <div id="myModal" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                              <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Verwijderen</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Weet je zeker dat je deze wereld wilt verwijderen?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form action="{{ url('werelden/'.$wereld->wereld_id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-danger">Verwijderen</button>
                                                    </form>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </tr> 
                                <?php }}); ?>   
                            </tbody>
                        </table>
                                    
                    </div>
                </div>             
            </div>
            <!-- wereldoverzicht -->

            

            <!-- wereld toevoegen -->
            <div class="tab-pane fade" id="wereldenToevoegen">
                <div class="panel panel-default">
                    <div class="panel-heading">Wereld toevoegen <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        @include('common.errors')
                            <form action="{{ url('werelden/post') }}" method="POST">
                            {{ csrf_field() }}
                                <input type="text" name="naam" class="form-control verhaal-toevoegen" placeholder="Naam">
                                <input type="hidden" value="{{ $verhaal[0]->verhaal_id }}" name="verhaal_id">
                                <textarea class="form-control" id="verhaal-text" name="beschrijving" placeholder="Beschrijving"></textarea>
                                <button type="submit" class="btn btn-primary">Voeg wereld toe</button>
                            </form> 
                        </div>
                </div>
            </div>
            <!-- wereld toevoegen -->

            <!-- personage gedeelte* -->
            <div class="tab-pane fade" id="personages">
                 <script type="text/javascript">
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#personagePic').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                </script>
                <form action="" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-6 basisinfo">
                        <input class="col-md-12 form-control" placeholder="naam" type="text">
                        <input class="col-md-12 form-control" placeholder="leeftijd" type="text">
                        <label for="levend">Levend</label><input class="form-control" name="levend" type="checkbox">
                        <textarea class="col-md-12 form-control" name="persoonlijkheid" placeholder="Karaktereigenschappen" cols="30" rows="10"></textarea>
                        <textarea name="superkrachten"class="col-md-6 form-control" placeholder="Superkrachten" cols="30" rows="10"></textarea>
                    </div>
                    <div class="personage-afbeelding col-md-6">
                        <img id="personagePic" src="" alt="Voeg foto toe" />
                        <input type="file" class="btn btn-primary" onchange="readURL(this);" placeholder="Voeg afbeelding toe">  
                    </div>
                    <div class="personage-overig col-md-12">
                        <textarea class="col-md-12 form-control" name="achtergrondinformatie" placeholder="Achtergrondinformatie" id="" cols="30" rows="10"></textarea>
                       <textarea class="form-control" name="opmerkingen" placeholder="Voeg hier eventueel opmerkingen toe" cols="30" rows="10"></textarea>
                    </div>
                    <input type="submit">
                </form>
                <div class="clear"></div>
                </div>

            </div>
            <!-- personage gedeelte* -->

        </div>
        <!-- content -->

    </div>  
    <!-- container -->
@stop