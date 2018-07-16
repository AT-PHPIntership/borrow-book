@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <section class="container">
        <div id="scanner-container"></div>
        <input type="button" id="btn" value="Start/Stop the scanner"/>
        <div class="alert alert-danger alert-dismissible fade in" hidden>
        </div>
    </section>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>{{trans('book.list_book')}}</h2>
        <h4><a class="btn btn-primary" href="{{route('admin.books.create')}}"><i class="fa fa-plus"> {{trans('book.create')}}</i></a></h4>
    </section>
    @include('admin.layouts.partials.errors')
    @include('admin.layouts.partials.messages')

    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="search-container">
                    <form action="{{route('admin.books.index')}}" method="GET" class="form-search-book">
                        <input type="text" placeholder="{{trans('book.form.placeholders.search')}}" name="search">
                        <button type="submit" class="button-search-book"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                @include('admin.layouts.partials.message_search')
                <table class="table box" id="table-index">
                    <thead>
                        <tr>
                            <th>{{trans('book.table_head.image')}}</th>
                            <th id="book-sort-title">@sortablelink('title', trans('book.table_head.title'))</th>
                            <th id="book-sort-author">@sortablelink('author', trans('book.table_head.author'))</th>
                            <th>{{trans('book.table_head.language')}}</th>
                            <th id="book-sort-quantity">@sortablelink('quantity', trans('book.table_head.quantity'))</th>
                            <th>{{trans('user.table_head.options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book )
                        <tr>
                            <td>
                            @foreach ($book->imageBooks as $image)
                                @if ($loop->first)
                                    <img class="text-center img-style" src="{{ $image->image_url }}" alt="">
                                @endif
                            @endforeach
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->language }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-primary btn-flat fa fa-pencil button-edit"></a>
                                <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-flat fa fa-trash-o btn-delete-item"
                                    onclick="return confirm('{{trans('book.messages.confirm_delete')}}')">
                                    </button>
                                </form> 
                                <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-primary btn-flat fa fa-info button-info"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $books->appends(\Request::except('page'))->render() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
    <script src="bower_components/quagga/dist/quagga.min.js"></script>
    <script src="{{ asset('js/readBarcode.js') }}"></script>
@endsection
