@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-detail-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="product-entry">
                                    <div class="product-img" id="profile-img">
                                    </div>
                                    <div class="name text-center"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="desc" id="detail">
                                    <h3 class="name"></h3>
                                    <div class="color-wrap">
                                        <p class="color-desc" id="dob">{{ trans('user.form.title_inputs.dob') }} :
                                        </p>
                                    </div>
                                    <hr/>
                                    <div class="color-wrap">
                                        <p class="color-desc" id="email">{{ trans('user.form.title_inputs.email') }} :
                                        </p>
                                    </div>
                                    <hr/>
                                    <div class="color-wrap">
                                        <p class="color-desc" id="identity_number">{{ trans('user.form.title_inputs.identity_number') }} :
                                        </p>
                                    </div>
                                    <hr/>
                                    <div class="color-wrap">
                                        <p class="color-desc" id="address">{{ trans('user.form.title_inputs.address') }} :
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/userProfile.js') }}"></script>
@endsection
