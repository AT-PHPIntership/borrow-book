@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-wrap">
                    <h3>{{ __('Login') }}</h3>
                    <form id="loginForm">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="{{ __('Login') }}" class="btn btn-success">
                            <a href="{{ route('password.email')}}" class="text-info">{{ __('resetPassword.forget_password') }}</a>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="js/user/login.js"></script>
@endsection
