@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6 col-md-push-3" style="background-color: #4e5d6c; padding: 25px; border-radius: 4px;">
            <div class="col-md-3" style="padding: 0px !important;">
                <img src="{{ URL::asset('images/user.png') }}" style="width: 100%;">
            </div>
            <div class="col-md-9" style="padding: 0px 0px 0px 15px !important;">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    <div class="col-md-8">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mailadres">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>   
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="Wachtwoord">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="display: block;height: 92px;float: right;">
                                <i class="fa fa-btn fa-sign-in"></i>Login
                            </button>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
