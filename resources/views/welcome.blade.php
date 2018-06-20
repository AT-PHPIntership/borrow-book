@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
                        <h2><span>New Arrival Books</span></h2>
                        <p>The news books is arrival</p>
                    </div>
                </div>
            <div class="row" id="books">
                
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/showListNewBook.js') }}"></script>
@endsection
