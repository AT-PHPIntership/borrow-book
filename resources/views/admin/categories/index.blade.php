@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('category.list_category')}}</h3>
    </section>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-5">
                <table class="table box">
                    <thead>
                        <tr>
                            <th>{{trans('category.table_head.name')}}</th>
                            <th >{{trans('category.table_head.action')}}</th>
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
