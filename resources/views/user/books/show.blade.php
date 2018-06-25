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
                                    <div class="color-wrap">
                                        <p class="color-desc">{{ trans('book.form.title_inputs.quantity')}} :
                                        </p>

                                        <div class="sidebar">
                                            <div class="colorlib-form-2" class="form-group">
                                                <input name="quantity" id="quantity" type="number" value="1" min="1" class="form-control">
                                            </div>
                                        </div>
                                        <input name="book_id" type="number" id="book-id" hidden>
                                    </div>
                                    <p><a class="btn btn-primary borrowing">Borrowing</a></p>
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
                                        <div class="col-md-7" id="content-review">
                                        </div>
                                    </div>
                                </div>
                                <div id="comment" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-7" id="content-comment">
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
