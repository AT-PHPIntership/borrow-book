@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="contact-wrap">
                <h3>{{ trans('register.register') }}</h3>
                <form id="register-form">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="name">{{ trans('register.name') }}</label>
                            <input id="name" type="text" class="form-control" name="name">
                            <span class="invalid-feedback" hidden>
                                <small class="text-danger" id="name-error"></small>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="identity_number">{{ trans('register.identity_number') }}</label>
                            <input id="identity-number" type="text" class="form-control" name="identity_number">
                            <span class="invalid-feedback" hidden>
                                <small class="text-danger" id="identity-number-error"></small>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="email">{{ trans('register.email') }}</label>
                            <input id="email" type="email" class="form-control" name="email">
                            <span class="invalid-feedback" hidden>
                                <small class="text-danger" id="email-error"></small>
                            </span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="password">{{ trans('register.password') }}</label>
                            <input id="password" type="password" class="form-control" name="password">
                            <span class="invalid-feedback" hidden>
                                <small class="text-danger" id="password-error"></small>
                            </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="password-confirmation">{{ trans('register.password_confirmation') }}</label>
                            <input id="password-confirmation" type="password" class="form-control" name="password_confirmation">
                            <span class="invalid-feedback" hidden>
                                <small class="text-danger" id="password-confirmation-error"></small>
                            </span>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="{{ trans('register.register') }}" class="btn btn-success">
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/register.js') }}"></script>
@endsection
