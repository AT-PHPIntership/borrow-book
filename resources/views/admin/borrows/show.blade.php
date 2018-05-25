@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('borrow.borrow_detail')}}</h3>
    </section>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="card-body">
                <div class="col-md-10"><p>{{trans('borrow.table_head.avatar')}}</p></div>
                <div class="col-md-10"><p>{{trans('borrow.table_head.borrower')}}</p></div>
                <div class="col-md-10"><p>{{trans('borrow.table_head.number_book')}}</p></div>
                <div class="col-md-10"><p>{{trans('borrow.table_head.from_date')}}</p></div>
                <div class="col-md-10"><p>{{trans('borrow.table_head.to_date')}}</p></div>
                <div class="col-md-10"><p>{{trans('borrow.table_head.status')}}</p></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
