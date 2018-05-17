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
                        <tr>
                            <td></td>
                            <td>King's ring</td>
                            <td>A</td>
                            <td>Englist</td>
                            <td>1</td>
                        </tr>
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
