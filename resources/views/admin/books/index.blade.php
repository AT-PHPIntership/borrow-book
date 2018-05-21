@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('book.list_book')}}</h3>
    </section>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <table class="table box">
                    <thead>
                        <tr>
                            <th>{{trans('book.table_head.image')}}</th>
                            <th>{{trans('book.table_head.title')}}</th>
                            <th>{{trans('book.table_head.author')}}</th>
                            <th>{{trans('book.table_head.language')}}</th>
                            <th>{{trans('book.table_head.quantity')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book )
                        <tr>
                            @foreach ($book->imageBooks as $image)
                                @if ($loop->first)
                                    <td><img class="text-center" src="{{ $image->image_url }}" alt=""></td>
                                @endif
                            @endforeach
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->language }}</td>
                            <td>{{ $book->quantity }}</td>
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
