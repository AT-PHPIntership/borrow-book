@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('borrow.list_borrow')}}</h3>
    </section>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <table class="table box">
                    <thead>
                        <tr>
                            <th>{{trans('borrow.table_head.avatar')}}</th>
                            <th>{{trans('borrow.table_head.borrower')}}</th>
                            <th>{{trans('borrow.table_head.number_book')}}</th>
                            <th>{{trans('borrow.table_head.from_date')}}</th>
                            <th>{{trans('borrow.table_head.to_date')}}</th>
                            <th>{{trans('borrow.table_head.status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td><img class="text-center a" src="{{ $borrow->user->avatar_url}}" alt=""></td>
                                <td>{{ $borrow->user->name }}</td>
                                <td>{{ $borrow->number_book }}</td>
                                <td>{{ date('d-m-Y', strtotime($borrow->form_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($borrow->to_date)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $borrows->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
