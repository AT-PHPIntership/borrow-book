@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-wrap">
                    <h3>{{ __('resetPassword.reset_password') }}</h3>
                    <form id="send-mail-form">
                        <div class="alert alert-success" hidden></div>
                        <div class="alert alert-danger" hidden></div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">{{ __('register.email') }}</label>
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="send-email-reset">
                                    {{ __('resetPassword.button.link_reset') }}
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

