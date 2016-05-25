@extends('layouts.app')

@section('content')

    <div class="container">
    <span id="danger"><span class="dd animated bounce">
        <div class="col-md-6 col-md-push-3" style="background-color: #4e5d6c; padding: 25px; border-radius: 4px;">
            <div class="col-md-3" style="padding: 0px !important;">
                <img src="{{ URL::asset('images/user.png') }}" style="width: 100%;">
            </div>
            <div class="col-md-9" style="padding: 0px 0px 0px 15px !important;">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}
                    <div class="col-md-9">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mailadres">
                        </div>   
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="Wachtwoord">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Onthoud mij
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                        <div class="form-group" style="margin-bottom: 0px;">
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                </div>
                            @endif
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="display: block;height: 92px;float: right;border-radius: 4px;">
                                <i class="fa fa-btn fa-sign-in"></i>Login
                            </button>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
        </span></span> 
    </div>
   
@endsection
