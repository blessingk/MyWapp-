@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="col-md-12 panel-heading">WELCOME TO WAPP</div>
                    <div class="panel-body">
                        <div class="row">
                            <h4 class="col-md-12 text-primary text-center">Click the login button if you already have an account with us, alternatively register.</h4><br><br><br><br><br><br>
                            <div class="col-md-6 col-md-offset-2">
                                <a href="{{ route('login') }}" class="btn btn-success btn-md ">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-primary btn-md pull-right">Register</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
