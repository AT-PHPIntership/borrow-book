@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container-fluid">
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
                            <div class="col-md-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#recent_post" aria-expanded="true">{{ __('profile.recent_post') }}</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#borrow" aria-expanded="false">{{ __('profile.recent_borrow') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="recent_post" class="tab-pane fade active in">
                                        <div class="row">
                                            <div id="table-content">
                                                <div class="alert alert-info review_success" hidden>@lang('post.send_review_success')</div>
                                                <div class="alert alert-danger review_error" hidden></div>
                                                <div class="alert alert-danger delete_error" hidden></div>
                                                <table class="table table-striped table-sm ">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-7">{{ __('profile.profile_content') }}</th>
                                                            <th class="col-md-7">{{ __('profile.profile_rate') }}</th>
                                                            <th class="col-md-3">{{ __('profile.profile_book') }}</th>
                                                            <th class="col-md-2">{{ __('profile.profile_status') }}</th>
                                                            <th class="col-md-2">{{ __('profile.profile_type') }}</th>
                                                            <th class="col-md-2">{{ __('profile.profile_option') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="template-post" style="display:none;">
                                                            <td class="body col-md-10"></td>
                                                            <td class="rate col-md-2"></td>
                                                            <td class="book-name col-md-3"></td>
                                                            <td class="status col-md-2">
                                                                <button class="btn-posts-success btn btn-success fa fa-check" id="post-success"></button>
                                                                <button class="btn-posts-err btn btn-danger fa fa-close" id="post-err"></button>
                                                            </td>
                                                            <td class="type col-md-2"></td>
                                                            <td class="option col-md-2">
                                                                <a href="javascript:void(0)" class="delete-post-user"><i class="btn-flat fa fa-trash-o" style="color: red"></i></a> | 
                                                                <a href="javascript:void(0)" class="update-post-user" data-toggle="modal" data-target="#modal-update-post"><i class="btn-flat fa fa-pencil" style="color: green"></i></a>
                                                                <i class=""></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="modal fade" id="modal-update-post" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Form update</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="form-update-post" method="POST" class="form-horizontal form-label-left">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                                                            <div class='rating-stars text-right'>
                                                                                <ul id='stars'>
                                                                                    <li class='star' title='Poor' data-value='1'>
                                                                                        <i class='fa fa-star fa-fw'></i>
                                                                                    </li>
                                                                                    <li class='star' title='Fair' data-value='2'>
                                                                                        <i class='fa fa-star fa-fw'></i>
                                                                                    </li>
                                                                                    <li class='star' title='Good' data-value='3'>
                                                                                        <i class='fa fa-star fa-fw'></i>
                                                                                    </li>
                                                                                    <li class='star' title='Excellent' data-value='4'>
                                                                                        <i class='fa fa-star fa-fw'></i>
                                                                                    </li>
                                                                                    <li class='star' title='WOW!!!' data-value='5'>
                                                                                        <i class='fa fa-star fa-fw'></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <textarea rows="4" id="content-post" name="boby" class="form-control col-md-7 col-xs-12"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="btn-form-update">
                                                                            <button type="button" id="submit-update-post" class="btn btn-success">Submit</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <nav class="paginate-profile text-right">
                                              <a id="next" hidden href="">{{ __('profile.next') }}>></a>
                                            </nav>
                                        </div>
                                    </div>
                                    <div id="borrow" class="tab-pane fade">
                                        <div class="row">
                                           <div id="table-content">
                                                <table class="table table-striped table-sm ">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-md-3">{{ trans('borrow.table_head.from_date') }}</th>
                                                            <th class="col-md-2">{{ trans('borrow.table_head.to_date') }}</th>
                                                            <th class="col-md-2">{{ trans('borrow.table_head.status') }}</th>
                                                            <th class="col-md-2">{{ trans('borrow.table_head.detail') }}</th>
                                                            <th class="col-md-2">{{ trans('borrow.table_head.options') }}</th>
                                                            <th class="col-md-2">{{ trans('user.message') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="template-borrow" style="display:none;">
                                                            <td class="from-date col-md-3"></td>
                                                            <td class="to-date col-md-2"></td>
                                                            <td class="status col-md-2">
                                                                <p class="label label-success" style="display:none;">{{ trans('borrow.status.borrowing') }}</p>
                                                                <p class="label label-primary" style="display:none;">{{ trans('borrow.status.give_back') }}</p>
                                                                <p class="label label-warning" style="display:none;">{{ trans('borrow.status.waitting') }}</p>
                                                                <p class="label label-danger" style="display:none;">{{ trans('borrow.status.cancel') }}</p>
                                                            </td>
                                                            <td class="col-md-2">
                                                                <ul class="list-group" id="template-borrow-detail" style="display:none;">
                                                                    <li class="list-group-item borrow-detail">
                                                                        <p class="book-title"></p>
                                                                        <p class="book-quantity"></p>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td class="col-md-2 btn_cancel">
                                                                <button class="btn btn-danger btn-cancel" style="display:none;">{{ trans('borrow.status.cancel') }}</button>
                                                            </td>
                                                                <button class="btn btn-danger btn-cancel" style="display:none;">{{ trans('borrow.status.cancel') }}</button>
                                                            <td class="col-md-2 alert alert-success done" style="display:none;" >
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <strong>{{ trans('auth.done')}}</strong> 
                                                            </td>
                                                            <td class="col-md-2 alert alert-danger error" style="display:none;" >
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <strong class="lb-error"></strong> 
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="note_cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered note_cancel" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5>{{ trans('user.note_cancel') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>   
                                                </div>
                                                <div class="modal-body">
                                                    <form id="demo-form2" method="POST" class="form-horizontal form-label-left">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-6 col-xs-12">
                                                                <textarea rows="5" id="note" name="note" class="form-control col-md-7 col-xs-12"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                                                                <input type="submit" id="note_cancel_submit" class="btn btn-success" value="{{ trans('user.form.buttons.submit') }}">
                                                              
                                                            </div>
                                                        </div>
                                                    </form>
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
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/userProfile.js') }}"></script>
<script src="{{ asset('js/userPost.js') }}"></script>
<script src="{{ asset('js/userBorrow.js') }}"></script>
@endsection
