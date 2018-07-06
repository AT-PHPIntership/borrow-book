@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1 cart">
                    <div class="product-name">
                        <div class="one-forth text-center">
                            <span>{{ trans('cart.book_details') }}</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>{{ trans('cart.total') }}</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>{{ trans('cart.remove') }}</span>
                        </div>
                        <div class="one-eight text-center" id="modal-cart">
                            <button data-toggle="modal" data-target="#calender" class="btn btn-primary">{{ trans('cart.add_cart') }}</button>
                        </div>
                        <div class="modal fade" id="calender" role="dialog">
                            <div class="modal-dialog">
                                <form class="form-inline" id="checkout">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ trans('cart.add_cart') }}</h4>
                                        </div>
                                        <div class="modal-body">
                                                <div class="container">
                                                    
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="from_date">{{ trans('cart.from_date') }}</label>
                                                            <input type="date" name="from_date" value="{{ date('Y-m-d') }}">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="to_date">{{ trans('cart.to_date') }}</label>
                                                            <input type="date" name="to_date"  value="{{ date('Y-m-d') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">{{ trans('cart.submit') }}</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('cart.close') }}</button>
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
    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                    <h2><span>{{ trans('cart.recommend_book.recommend_book') }}</span></h2>
                </div>
            </div>
            <div class="row recommed-cart-book">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/viewCart.js') }}"></script>
@endsection
