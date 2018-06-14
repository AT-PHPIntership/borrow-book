@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-push-2" >
                    <div class="row row-pb-lg" id="books">
                        
                    </div>
                </div>
            </div>
            <div class="text-center">
                <ul class="pagination" id="pagination">
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="js/showListBook.js"></script>
@endsection
