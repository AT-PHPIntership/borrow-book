@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row" id="books">
            </div>
            <div class="text-center">
                <ul class="pagination" id="pagination">
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="js/showListCategories.js"></script>
<script src="js/showListBook.js"></script>
@endsection
