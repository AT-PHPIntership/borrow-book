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
                                    <div class="product-img" id="product" style="background-image: url('../storage/images/default-book.png')">
                                    </div>
                                    <div class="thumb-nail">
                                        <a href="#" class="thumb-img" style="background-image: url();"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="desc" id="detail">
                                    <h3 id="title"></h3>
                                    <p class="price">
                                        <span id='author'></span> 
                                        <span class="rate text-right" id="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </p>
                                    <p id="description"></p>
                                    <div class="color-wrap">
                                        <p class="color-desc" id="category">{{ trans('book.form.title_inputs.category')}} :
                                        </p>
                                    </div>
                                    <div class="color-wrap">
                                        <p class="color-desc" id="number_of_page">{{ trans('book.form.title_inputs.number_of_page')}} :
                                        </p>
                                    </div>
                                    <div class="color-wrap">
                                        <p class="color-desc" id="language">{{ trans('book.form.title_inputs.language')}} :
                                        </p>
                                    </div>
                                      <div class="color-wrap">
                                        <p class="color-desc" id="publishing_year">{{ trans('book.form.title_inputs.publishing_year')}} :
                                        </p>
                                    </div>
                                    <p><a href="" class="btn btn-primary">Borrowing</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-12 tabulation">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#review" aria-expanded="true">{{ trans('book.review') }}</a></li>
                                <li><a data-toggle="tab" href="#comment" aria-expanded="false">{{ trans('book.comment') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="review" class="tab-pane fade active in">
                                    <div class="row">
                                        <div class="col-md-7" class="review" >
                                                <label>@lang('post.rating_message'):</label>
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
                                                <div>
                                                    <label for="review_detail">@lang('post.review_message'):</label>
                                                <div class="content" >
                                                    <textarea  placeholder="@lang('post.post_message')" class="form-control" name="detail" id="content_review" ></textarea>
                                                </div>
                                                <div class="alert alert-info" hidden>@lang('post.send_review_success')</div>
                                                <div id="dob_error" class="alert alert-danger" hidden></div>
                                                <div class="action">
                                                <div class="word-counter"></div>
                                                    <button class="btn btn-success btn-add-review " id="add_review">@lang('post.btn_send_review')</button>
                                                </div>
                                                </div>
                                                <div id="content-review"></div>
                                        </div>

                                    </div>
                                </div>
                                <div id="comment" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-7">
                                                <label for="review_detail">@lang('post.review_message'):</label>
                                                <div class="content" >
                                                    <textarea  placeholder="@lang('post.post_message')" class="form-control" name="detail" id="content_cmt" ></textarea>
                                                </div>
                                                <div class="alert alert-info" hidden>@lang('post.send_success')</div>
                                                <div id="dob_error" class="alert alert-danger" hidden></div>
                                                <div class="action">
                                                <div class="word-counter"></div>
                                                    <button class="btn btn-success btn-add-review " id="add_comment">@lang('post.btn_send_cmt')</button>
                                                </div>
                                            <hr/>
                                            <div  id="content-comment"></div>
                                           
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
<script src="{{ asset('js/showDetailBook.js') }}"></script>
<script src="{{ asset('js/posts.js') }}"></script>
@endsection
