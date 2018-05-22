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
                            <th>{{trans('borrow.table_head.borrower')}}</th>
                            <th>{{trans('borrow.table_head.number_book')}}</th>
                            <th>{{trans('borrow.table_head.form_date')}}</th>
                            <th>{{trans('borrow.table_head.to_date')}}</th>
                            <th>{{trans('borrow.table_head.options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="text-center">
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
