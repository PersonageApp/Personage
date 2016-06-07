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
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    Families <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=""><a href="#familieOverzicht" data-toggle="tab" aria-expanded="false">Overzicht</a></li>
                    <li class=""><a href="#familieToevoegen" data-toggle="tab" aria-expanded="true">Toevoegen</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    Personages <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class=""><a href="#personageOverzicht" data-toggle="tab" aria-expanded="false">Overzicht</a></li>
                    <li class=""><a href="#personageToevoegen" data-toggle="tab" aria-expanded="true">Toevoegen</a></li>
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

                <div class="panel panel-info">
                    <div class="panel-heading">Gegevens</div>
                    <div class="panel-body">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge"><?php echo $test = DB::table('werelden')->where('verhaal_id', $verhaal[0]->verhaal_id)->count(); ?></span>
                            Werelden
                          </li>
                          <li class="list-group-item">
                            <span class="badge">2</span>
                            Locaties
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?php echo $test = DB::table('families')->where('verhaal_id', $verhaal[0]->verhaal_id)->count(); ?></span>
                            Families
                          </li>
                          <li class="list-group-item">
                            <span class="badge">1</span>
                            Personages
                          </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 panel kop">
                    <h2>Werelden</h2>
                </div>
                <div class="wereldverhaal">
                    <?php DB::table('werelden')->orderBy('wereld_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($werelden) {
                    $i =0; foreach ($werelden as $wereld) { $i++; ?>
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">Wereld <?php echo $i; ?></div>
                                <div class="panel-body">
                                    <h4>{{ $wereld->naam }}</h4>
                                    <p>{{ $wereld->beschrijving }}</p>
                                    <div class="hrd"></div>
                                    <h4>Locaties</h4>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                          <tr>
                                            <th width="15%">Foto</th>
                                            <th width="20%">Naam</th>
                                            <th width="65%">Beschrijving</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><img src="http://www.startpagina.nl/athene/dochters/google-maps/images/vraagteken.png"></td>
                                                <td>{{ $wereld->naam }}</td>
                                                <td>{{ $wereld->beschrijving }}</td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php }}); ?>
                </div>
                <div class="col-md-12 panel kop">
                    <h2>Families</h2>
                </div>
                <div class="wereldverhaal">    
                    <?php DB::table('families')->orderBy('familie_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($families) {
                    $i =0; foreach ($families as $familie) { $i++; ?>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Familie <?php echo $i; ?></div>
                                <div class="panel-body">
                                    <h4>{{ $familie->naam }}</h4>
                                    <p>{{ $familie->beschrijving }}</p>
                                    <p>
                                        <h4>Geschiedenis</h4>
                                        <i>{{ $familie->geschiedenis }}</i>
                                    </p>
                                    <div class="hrd"></div>
                                    <h4>Personages</h4>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                          <tr>
                                            <th width="85%">Naam</th>
                                            <th width="15%">Meer info</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $familie->naam }}</td>
                                                <td>
                                                    <button class="info" data-toggle="modal" data-target="#myModal"><img src="{{ URL::asset('info.png') }}"></button>
                                                </td>
                                                <div id="myModal" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Personage</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <p>info{{ $familie->naam }}</p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Sluit</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php }}); ?>   
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

            <!-- familieoverzicht -->
            <div class="tab-pane fade" id="familieOverzicht">
                <div class="panel panel-default">
                    <div class="panel-heading">Familie overzicht <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="5%">#</th>
                                <th width="10%">Naam familie</th>
                                <th width="32.5%">Beschrijving</th>
                                <th width="32.5%">Geschiedenis</th>
                                <th width="10%">Bewerken</th> 
                                <th width="10%">Verwijderen</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php DB::table('families')->orderBy('familie_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($families) {
                                    $i =0; foreach ($families as $familie) { $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $familie->naam }}</td>
                                            <td>{{ $familie->beschrijving }}</td>
                                            <td>{{ $familie->geschiedenis }}</td>
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
            <!-- familieoverzicht -->

            <!-- locatieoverzicht -->
            <div class="tab-pane fade" id="locatieOverzicht">
                <div class="panel panel-default">
                    <div class="panel-heading">Locatie overzicht <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="5%">#</th>
                                <th width="10%">Foto</th>
                                <th width="10%">Naam locatie</th>
                                <th width="32.5%">Beschrijving</th>
                                <th width="10%">Bewerken</th> 
                                <th width="10%">Verwijderen</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php DB::table('locaties')->orderBy('locatie_id')->join('werelden', 'locaties.wereld_id', '=', 'werelden.wereld_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($locaties) {
                                    $i =0; foreach ($locaties as $locatie) { $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $locatie->naam }}</td>
                                            <td>{{ $locatie->beschrijving }}</td>
                                            <td>{{ $locatie->afbeelding }}</td>
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
            <!-- locatieoverzicht -->

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

            <!-- familie toevoegen -->
            <div class="tab-pane fade" id="familieToevoegen">
                <div class="panel panel-default">
                    <div class="panel-heading">Familie toevoegen <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        @include('common.errors')
                            <form action="{{ url('families/post') }}" method="POST">
                            {{ csrf_field() }}
                                <input type="text" name="naam" class="form-control verhaal-toevoegen" placeholder="Naam">
                                <input type="hidden" value="{{ $verhaal[0]->verhaal_id }}" name="verhaal_id">
                                <textarea class="form-control" id="verhaal-text" name="beschrijving" placeholder="Beschrijving"></textarea>
                                <textarea class="form-control" id="verhaal-text" name="geschiedenis" placeholder="Geschiedenis"></textarea>
                                <button type="submit" class="btn btn-primary">Voeg wereld toe</button>
                            </form> 
                        </div>
                </div>
            </div>
            <!-- familie toevoegen -->

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