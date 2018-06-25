@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-name">
                        <div class="one-forth text-center">
                            <span>{{ trans('cart.book_details') }}</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>{{ trans('cart.from_date') }}</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>{{ trans('cart.to_date') }}</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>{{ trans('cart.total') }}</span>
                        </div>
                        <div class="one-eight text-center">
                            <span>{{ trans('cart.remove') }}</span>
                        </div>
                    </div>
                    <div class="product-cart">
                        <div class="one-forth">
                            <div class="product-img" style="background-image: url(../storage/images/default-book.png);">
                            </div>
                            <div class="display-tc">
                                <h3></h3>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span class="price"></span>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <span class="price"></span>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100" disabled>
                            </div>
                        </div>
                        <div class="one-eight text-center">
                            <div class="display-tc">
                                <a href="#" class="closed"></a>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
