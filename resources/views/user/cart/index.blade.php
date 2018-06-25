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
                        <div class="one-eight text-center">
                            <button data-toggle="modal" data-target="#calender" class="btn btn-primary">Add Cart</button>
                        </div>
                        <div class="modal fade" id="calender" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Cart</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-inline" id="checkout">
                                            <div class="container">
                                                
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="form_date">From Date</label>
                                                        <input type="date" name="form_date">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="to_date">To Date</label>
                                                        <input type="date" name="to_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script src="{{ asset('js/viewCart.js') }}"></script>
@endsection
