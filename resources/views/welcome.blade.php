@extends('layouts.master')
@section('content')
    <div id="colorlib-featured-product">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('books.index') }}" class="f-product-1" style="background-image: url({{ asset('/images/product1.jpg') }});">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('books.index') }}" class="f-product-2" style="background-image: url({{ asset('/images/product2.jpg') }});">
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('books.index') }}" class="f-product-2" style="background-image: url({{ asset('/images/product3.jpg') }});">
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ route('books.index') }}" class="f-product-2" style="background-image: url({{ asset('/images/product4.jpg') }});">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                        <h2><span>{{ trans('homepage.new_book.new_arrival') }}</span></h2>
                        <p class="decription-title">{{ trans('homepage.new_book.decription') }}</p>
                    </div>
                </div>
            <div class="row" id="new-books">
                
            </div>
            <div class="text-center"><a href="{{ route('books.index') }}" id="show-more">{{ trans('homepage.show_more') }}</a></div>
        </div>
    </div>
    <div id="colorlib-intro" class="colorlib-intro" style="background-image: url({{ asset('/images/product2.jpg') }}); background-position: 50% 71px;" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="intro-desc">
                        <div class="text-salebox">
                            <div class="text-lefts">
                                <div class="sale-box">
                                    <div class="sale-box-top">
                                        <h2 class="number">{{ trans('homepage.relax') }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="text-rights">
                                <h3 class="title">{{ trans('homepage.banner.banner_3.category') }}</h3>
                                <p>{{ __('Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.') }}</p>
                                <p><a href="{{ route('books.index') }}" class="btn btn-primary btn-outline">{{ trans('homepage.banner.banner_1.head_1') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                    <h2><span>{{ trans('homepage.you_book.book_you_need') }}</span></h2>
                    <p>{{ trans('homepage.you_book.decription') }}</p>
                </div>
            </div>
            <div class="row recommend-list-book">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/showListNewBook.js') }}"></script>
@endsection
