@extends('layouts.loginRegister')
@section('content')

<div class='row'>
    <div class='col-sm-12'>

        <div class='wrapper-page'>

            <div class='m-t-40 account-pages'>
                <div class='text-center account-logo-box'>
                    <h2 class='text-uppercase'>
                        <a href='#' class='text-success'>
                            <span><img src='{{url('/assets/images/logo.png')}}' alt='' height='60'></span>
                        </a>
                    </h2>
                    <!--<h4 class='text-uppercase font-bold m-b-0'>Sign In</h4>-->
                </div>




                <div class="account-content">
                    <form class="form-horizontal" action='{{ url('/login') }}' method='post'>
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input id='email' type='email' name='email' class='form-control' value='{{ old('email') }}' required />
                                <label for='email' class=''>Email</label>
                                @if ($errors->has('email'))
                                <span class='help-block'>
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id='password' type='password' class='form-control'  name='password' required />
                                <label for='password'>Password</label>
                                @if ($errors->has('password'))
                                <span class='help-block'>
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                        <div class="form-group account-btn text-center m-t-10">
                            <div class="col-xs-12">
                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                    </form>

                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- end card-box-->


            <div class='row m-t-50'>
                <div class='col-sm-12 text-center'>
                    <a href='{{ url('/password/reset') }}'>
                        Esqueceu ou ainda não tem a sua senha? <b>Clique aqui.</b>
                    </a>
                </div>
            </div>

        </div>
        <!-- end wrapper -->

    </div>
</div>

@endsection