@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-wrap">
                    <h3>{{__('resetPassword.reset_password') }}</h3>
                    <form id="reset-password-form">
                        <input id="reset_token" type="hidden" name="token" value="{{ $token }}">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">{{ __('register.email') }}</label>
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                            </div>
                        </div>
                        <div class="alert alert-danger invalid-feedback-email" hidden></div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="password">{{ __('register.password') }}</label>
                                <input id="new-password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="password">{{ __('register.password_confirmation') }}</label>
                                <input id="re-password" type="password" class="form-control" name="re-password" required>
                            </div>
                        </div>
                        <div class="alert alert-danger invalid-feedback-password" hidden></div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="reset-password">
                                    {{ __('resetPassword.reset_password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/resetPassword.js') }}"></script>
@endsection
