@extends('layouts.loginRegister')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="wrapper-page">
            <div class="m-t-40 account-pages">
                <div class="text-center account-logo-box">
                    <h2 class="text-uppercase">
                        <a href="index.html" class="text-success">
                            <span><span><img src='{{url('/assets/images/logo.png')}}' alt='' height='60'></span></span>
                        </a>
                    </h2>
                </div>
                <div class="account-content">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        <input type="hidden" name="token" value="{{ $token }}">





                        {{ csrf_field() }}



                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Digite seu email"/>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Digite sua senha" minlength="6" />
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme sua senha"  minlength="6" />
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group account-btn text-center m-t-10">
                            <div class="col-xs-12">
                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">
                                    Confirmar senha
                                </button>
                            </div>
                        </div>

                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection