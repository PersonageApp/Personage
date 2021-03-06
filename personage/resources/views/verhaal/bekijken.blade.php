@extends('layouts.app')

@section('content')
@if (Auth::user())
    <!-- container --> 
    <div class="container">
        @if (Session::has('flash_notification.message'))
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_notification.message') }}
            </div>
        @endif

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

                <!-- het verhaal -->
                <div class="panel panel-default">
                    <div class="panel-heading">Het verhaal <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        <h2>{{ $verhaal[0]->naam }}</h2> 
                        <p>{{ $verhaal[0]->verhaal}}</p>
                    </div>
                </div>
                <!-- het verhaal -->

                <!-- verhaal gegegevens -->
                <div class="panel panel-info">
                    <div class="panel-heading">Gegevens</div>
                    <div class="panel-body">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge"><?php echo $test = DB::table('werelden')->where('verhaal_id', $verhaal[0]->verhaal_id)->count(); ?></span>
                            Werelden
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?php echo $test = DB::table('locaties')->join('werelden', 'locaties.wereld_id', '=', 'werelden.wereld_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->count(); ?></span>
                            Locaties
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?php echo $test = DB::table('families')->where('verhaal_id', $verhaal[0]->verhaal_id)->count(); ?></span>
                            Families
                          </li>
                          <li class="list-group-item">
                            <span class="badge"><?php echo $test = DB::table('personages')->join('families', 'personages.familie_id', '=', 'families.familie_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->count(); ?></span>
                            Personages
                          </li>
                        </ul>
                    </div>
                </div>
                <!-- verhaalgegevens -->

                <div class="col-md-12 panel kop">
                    <h2>Werelden</h2>
                </div>

                <!-- werelden & locaties in dit verhaal -->
                <div class="wereldverhaal">
                    <?php DB::table('werelden')->orderBy('wereld_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($werelden) {$i =0; foreach ($werelden as $wereld) { $i++; ?>
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
                                            <th width="85%">Naam</th>
                                            <th width="15%">Meer info</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php DB::table('locaties')->where('wereld_id', $wereld->wereld_id)->chunk(100, function($locaties) { $p =0; foreach ($locaties as $locatie) { $p++; ?>
                                            <tr>
                                                <td>{{ $locatie->naam }}</td>
                                                <td>
                                                    <button class="info" data-toggle="modal" data-target="#locatie<?php echo $p; ?>"><img src="{{ URL::asset('info.png') }}"></button>
                                                </td>
                                                <div id="locatie<?php echo $p; ?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Locatie</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div style="width: 50%; display: inline-block; float: left;">Naam</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">{{ $locatie->naam }}</div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Beschrijving</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">{{ $locatie->beschrijving }}</div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Afbeelding</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;"><img src="{{ $locatie->afbeelding }}" style="max-width: 100%;"></div>
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
                    <?php }}); ?>
                </div>
                <!-- werelden & locaties in dit verhaal -->

                <div class="col-md-12 panel kop">
                    <h2>Families</h2>
                </div>

                <!-- families & personages in dit verhaal -->
                <div class="wereldverhaal">    
                    <?php DB::table('families')->orderBy('familie_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($families) { $i =0; foreach ($families as $familie) { $i++; ?>
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
                                          <?php DB::table('personages')->where('familie_id', $familie->familie_id)->chunk(100, function($personages) { $p =0; foreach ($personages as $personage) { $p++; ?>
                                            <tr>
                                                <td>{{ $personage->naam }}</td>
                                                <td>
                                                    <button class="info" data-toggle="modal" data-target="#personage<?php echo $p; ?>"><img src="{{ URL::asset('info.png') }}"></button>
                                                </td>
                                                <div id="personage<?php echo $p; ?>" class="modal fade" role="dialog">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Personage</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div style="width: 50%; display: inline-block; float: left;">Naam</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">{{ $personage->naam }}</div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Leeftijd</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">{{ $personage->leeftijd }}</div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Geslacht</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">@if ($personage->geslacht === 'man') Man @else Vrouw @endif</div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Superkrachten</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">{{ $personage->superkrachten }}</div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Achtergrondinformatie</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">{{ $personage->achtergrondinformatie }}</div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Levend</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;">@if ($personage->levend === 1) Levend @else Overleden @endif </div>
                                                        <div style="width: 50%; display: inline-block; float: left;">Afbeelding</div>
                                                        <div style="width: 50%; display: inline-block; margin-bottom: 10px;"><img src="{{ $personage->afbeelding }}" style="max-width: 100%;"></div>
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
                    <?php }}); ?>   
                </div>     
                <!-- families en personages in dit verhaal -->

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
                                            <td><a href="{{ url('verhalen/'.$wereld->verhaal_id .'/bekijken/'. $wereld->wereld_id .'/edit') }}" class="btn btn-primary"><i class="fa fa-edit"> </i> Bewerken</a></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#wereldoverzicht<?php echo $i; ?>"><i class="fa fa-trash"></i> Verwijderen</button>
                                            </td>
                                            <div id="wereldoverzicht<?php echo $i; ?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                              <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Verwijderen</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Weet je zeker dat je deze wereld <strong>{{ $wereld->naam }}</strong> wilt verwijderen?<br>Alle locaties van deze wereld worden dan ook verwijderd.</p>
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

            <!-- locatieoverzicht -->
            <div class="tab-pane fade" id="locatieOverzicht">
                <div class="panel panel-default">
                    <div class="panel-heading">Locatie overzicht <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="5%">#</th>
                                <th width="10%">Naam locatie</th>
                                <th width="32.5%">Beschrijving</th>
                                <th width="10%">Bewerken</th> 
                                <th width="10%">Verwijderen</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php DB::table('werelden')->orderBy('wereld_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($werelden) {$i =0; foreach ($werelden as $wereld) { $i++; ?>
                                    <?php DB::table('locaties')->where('wereld_id', $wereld->wereld_id)->chunk(100, function($locaties) { $p =0; foreach ($locaties as $locatie) { $p++; ?>
                                        <tr>
                                            <td><?php echo $p; ?></td>
                                            <td>{{ $locatie->naam }}</td>
                                            <td>{{ $locatie->beschrijving }}</td>
                                            <td><a href="{{ url('wereld/'.$locatie->wereld_id .'/bekijken/'. $locatie->locatie_id .'/edit') }}" class="btn btn-primary"><i class="fa fa-edit"> </i> Bewerken</a></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#locatieoverzicht<?php echo $p; ?>"><i class="fa fa-trash"></i> Verwijderen</button>
                                            </td>
                                            <div id="locatieoverzicht<?php echo $p; ?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                              <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Verwijderen</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Weet je zeker dat je deze locatie <strong>{{ $locatie->naam }}</strong> wilt verwijderen?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form action="{{ url('locaties/'.$locatie->locatie_id) }}" method="POST">
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
                             <?php }}); ?>        
                            </tbody>
                        </table>
                                    
                    </div>
                </div>             
            </div>
            <!-- locatieoverzicht -->

            <!-- locatie toevoegen -->
            <div class="tab-pane fade" id="locatieToevoegen">
                <div class="panel panel-default">
                    <div class="panel-heading">Locatie toevoegen <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        @include('common.errors')
                            <form action="{{ url('locaties/post') }}" method="POST">
                            {{ csrf_field() }}
                                <input type="text" name="naam" class="form-control verhaal-toevoegen" placeholder="Naam">
                                <label for="select" class="col-lg-2 control-label" style="width: 10% !important; padding-top: 11px; font-size: 14px;">Wereld</label>
                                <select name="wereld_id" class="form-control verhaal-toevoegen verhaal-toevoegen2">
                                    <?php $werelden = DB::table('werelden')->where('verhaal_id', $verhaal[0]->verhaal_id)->get(); foreach ($werelden as $wereld) : ?>
                                        <option value="<?php echo $wereld->wereld_id; ?>"><?php echo $wereld->naam; ?></option>  
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" name="afbeelding" class="form-control verhaal-toevoegen" placeholder="Afbeelding">
                                <textarea class="form-control" id="verhaal-text" name="beschrijving" placeholder="Beschrijving"></textarea>
                                <button type="submit" class="btn btn-primary">Voeg locatie toe</button>
                            </form> 
                        </div>
                </div>
            </div>
            <!-- locatie toevoegen -->

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
                                            <td><a href="{{ url('verhalen/'.$familie->verhaal_id .'/bekijken/'. $familie->familie_id .'/familie/edit') }}" class="btn btn-primary"><i class="fa fa-edit"> </i> Bewerken</a></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#familie<?php echo $i; ?>"><i class="fa fa-trash"></i> Verwijderen</button>
                                            </td>
                                            <div id="familie<?php echo $i; ?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                              <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Verwijderen</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Weet je zeker dat je deze familie wilt verwijderen?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form action="{{ url('families/'.$familie->familie_id) }}" method="POST">
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
            <!-- familieoverzicht -->

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
                                <button type="submit" class="btn btn-primary">Voeg familie toe</button>
                            </form> 
                        </div>
                </div>
            </div>
            <!-- familie toevoegen -->

            <!-- personage overzicht -->
            <div class="tab-pane fade" id="personageOverzicht">
                <div class="panel panel-default">
                    <div class="panel-heading">Personage overzicht <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th width="5%">#</th>
                                <th width="20%">Naam personage</th>
                                <th width="15%">Geslacht</th>
                                <th width="15%">Leeftijd</th>
                                <th width="15%">Levend</th>
                                <th width="15%">Bewerken</th> 
                                <th width="15%">Verwijderen</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php DB::table('families')->orderBy('familie_id')->where('verhaal_id', $verhaal[0]->verhaal_id)->chunk(100, function($families) {$i =0; foreach ($families as $familie) { $i++; ?>
                                    <?php DB::table('personages')->where('familie_id', $familie->familie_id)->chunk(100, function($personages) { $p =0; foreach ($personages as $personage) { $p++; ?>
                                        <tr>
                                            <td><?php echo $p; ?></td>
                                            <td>{{ $personage->naam }}</td>
                                            <td>
                                                @if ($personage->geslacht === 'man')
                                                    Man
                                                @else    
                                                    Vrouw
                                                @endif
                                            </td>
                                            <td>{{ $personage->leeftijd }} jaar</td>
                                            <td>
                                                @if ($personage->levend === 1)
                                                    Levend
                                                @else    
                                                    Overleden
                                                @endif 
                                            </td>
                                            <td><a href="{{ url('familie/'.$personage->familie_id .'/bekijken/'. $personage->personage_id .'/edit') }}" class="btn btn-primary"><i class="fa fa-edit"> </i> Bewerken</a></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#personageoverzicht<?php echo $p; ?>"><i class="fa fa-trash"></i> Verwijderen</button>
                                            </td>
                                            <div id="personageoverzicht<?php echo $p; ?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                              <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Verwijderen</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Weet je zeker dat je deze personage <strong>{{ $personage->naam }}</strong> wilt verwijderen?</p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <form action="{{ url('personage/'.$personage->personage_id) }}" method="POST">
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
                             <?php }}); ?>        
                            </tbody>
                        </table>
                                    
                    </div>
                </div>             
            </div>
            <!-- personage overzicht -->

            <!-- personage toevoegen -->
            <div class="tab-pane fade" id="personageToevoegen">
                <div class="panel panel-default">
                    <div class="panel-heading">Personage toevoegen <p style="float: right">Verhaal: {{ $verhaal[0]->naam }}</p></div>
                    <div class="panel-body">
                        @include('common.errors')
                            <form action="{{ url('personages/post') }}" method="POST">
                            {{ csrf_field() }}
                                <input type="text" name="naam" class="form-control verhaal-toevoegen" placeholder="Naam">
                                <input type="text" name="afbeelding" class="form-control verhaal-toevoegen" placeholder="Afbeelding">
                                <input type="number" min="0" max="120" name="leeftijd" class="form-control verhaal-toevoegen" placeholder="Leeftijd">
                                <label for="select" class="col-lg-2 control-label" style="width: 10% !important; padding-top: 11px; font-size: 14px;">Geslacht</label>
                                <select name="geslacht" class="form-control verhaal-toevoegen verhaal-toevoegen2">
                                  <option value="man">Man</option>
                                  <option value="vrouw">Vrouw</option>
                                </select>
                                <input type="text" name="superkrachten" class="form-control verhaal-toevoegen" placeholder="Superkrachten">
                                <textarea class="form-control" id="verhaal-text" name="achtergrondinformatie" placeholder="Achtergrond Informatie"></textarea>
                                <label for="select" class="col-lg-2 control-label" style="width: 10% !important; padding-top: 11px; font-size: 14px;">Levend</label>
                                <select name="levend" class="form-control verhaal-toevoegen verhaal-toevoegen2">
                                  <option value="1">Levend</option>
                                  <option value="0">Overleden</option>
                                </select>
                                <textarea class="form-control" id="verhaal-text" name="opmerkingen" placeholder="Opmerkingen"></textarea>
                                <label for="select" class="col-lg-2 control-label" style="width: 10% !important; padding-top: 11px; font-size: 14px;">Familie</label>
                                <select name="familie_id" class="form-control verhaal-toevoegen verhaal-toevoegen2">
                                    <?php $families = DB::table('families')->where('verhaal_id', $verhaal[0]->verhaal_id)->get(); foreach ($families as $familie) : ?>
                                        <option value="<?php echo $familie->familie_id; ?>"><?php echo $familie->naam; ?></option>  
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-primary">Voeg personage toe</button>
                            </form> 
                        </div>
                </div>
            </div>
            <!-- personage toevoegen -->

            <!-- personage gedeelte -->
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
    @else
        <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Niet ingelogd</div>
          <div class="panel-body">Je bent niet ingelogd.</div>
         </div>
        </div>  
    @endif

@stop