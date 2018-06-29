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
                                    <ul class="list-unstyled user_data">
                                        <li  class="m-top-xs" id="name">
                                            <i class="fa fa-user profile-user"></i>
                                        </li>
                                        <li class="m-top-xs" id="address">
                                            <i class="fa fa-map-marker profile-user"></i>
                                        </li>
                                        <li class="m-top-xs" id="email">
                                            <i class="fa fa-envelope user-profile-icon profile-user"></i>
                                        </li>
                                        <li class="m-top-xs" id="dob">
                                            <i class="fa fa-birthday-cake profile-user"></i>
                                        </li>
                                        <li class="m-top-xs" id="identity_number">
                                            <i class="fa fa-address-card profile-user"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#recent_post" aria-expanded="true">{{ __('profile.recent_post') }}</a>
                                    </li>
                                    <li>  <a data-toggle="tab" href="#" aria-expanded="false">{{ __('profile.recent_borrow') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="recent_post" class="tab-pane fade active in">
                                        <div class="row">
                                           <div id="table-content">
                                                <table class="table table-striped table-sm ">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-7">{{ __('profile.profile_content') }}</th>
                                                            <th class="col-md-7">{{ __('profile.profile_rate') }}</th>
                                                                <th class="col-md-3">{{ __('profile.profile_book') }}</th>
                                                                <th class="col-md-2">{{ __('profile.profile_status') }}</th>
                                                            <th class="col-md-2">{{ __('profile.profile_type') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="template-post" style="display:none;">
                                                            <td class="body col-md-10"></td>
                                                            <td class="rate col-md-2"></td>
                                                            <td class="book-name col-md-3"></td>
                                                            <td class="status col-md-2">
                                                                <button class="hidden btn btn-success fa fa-check btn-posts-success" id="post-success"></button>
                                                                <button class="hidden btn-posts-err btn btn-danger fa fa-close" id="post-err"></button>
                                                            </td>
                                                            <td class="type col-md-2"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <nav class="paginate-profile text-right">
                                              <a id="next" hidden href="">{{ __('profile.next') }}>></a>
                                            </nav>
                                        </div>
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
<script src="{{ asset('js/userPost.js') }}"></script>
@endsection
