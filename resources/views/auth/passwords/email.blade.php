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
                    <div class="text-center m-b-20">
                        <p class="text-muted m-b-0 font-13">Digite seu endereço de e-mail e nós lhe enviaremos um e-mail com instruções para redefinir sua senha.</p>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input id='email' type='email' name='email' class='form-control validate' value='{{ old('email') }}' required placeholder="Enter email" />
                                @if ($errors->has('email'))
                                <span class='help-block'>
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group account-btn text-center m-t-10">
                            <div class="col-xs-12">
                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                                        type="submit">Enviar Email
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