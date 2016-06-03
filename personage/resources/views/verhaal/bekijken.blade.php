@extends('layouts.app')

@section('content')
    <div class="container">
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
            <li class="gaterug"><a href="{{ url('/') }}" >Ga terug</a></li>
        </ul>
        <div id="myTabContent verhalentab" class="tab-content">
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
                                            <td><button class="btn btn-primary">Bewerk</button></td>
                                            <td><button class="btn btn-danger">Verwijder</button></td>
                                        </tr> 
                                <?php }}); ?>   
                            </tbody>
                        </table>        
                    </div>
                </div>             
            </div>
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
            <div class="tab-pane fade" id="families">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
            </div>
            <div class="tab-pane fade" id="personages">
                <p>Tnd seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
            </div>
        </div>
    </div>  
@stop