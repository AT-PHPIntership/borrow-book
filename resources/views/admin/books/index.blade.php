@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
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
                    <form action="{{route('admin.books.index')}}" method="GET">
                        <input type="text" placeholder="Search" name="search">
                        <button type="submit" class="button-search-book"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="show-detail-search">
                    <strong>{{trans('book.search_book.results', ['number' => $books->count()])}}</strong>
                </div>
                <table class="table box">
                    <thead>
                        <tr>
                            <th>{{trans('book.table_head.image')}}</th>
                            <th>{{trans('book.table_head.title')}}</th>
                            <th>{{trans('book.table_head.author')}}</th>
                            <th>{{trans('book.table_head.language')}}</th>
                            <th>{{trans('book.table_head.quantity')}}</th>
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
                                 <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-primary btn-flat fa fa-pencil"></a>&nbsp;&nbsp;
                                <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-flat fa fa-trash-o btn-delete-item"
                                    onclick="return confirm('{{trans('book.messages.confirm_delete')}}')">
                                    </button>
                                </form> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
