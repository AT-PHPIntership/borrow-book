@extends('layouts.master')
@section('content')
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
@endsection
@section('scripts')
<script src="{{ asset('js/showListNewBook.js') }}"></script>
@endsection
