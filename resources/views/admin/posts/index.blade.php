@extends('admin.layouts.admin')

@section('title', trans('post.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('post.list_post')}}</h3>
    </section>
    @include('admin.layouts.partials.errors')
    @include('admin.layouts.partials.messages')

    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <table class="table box">
                    <thead>
                        <tr>
                            <th>{{trans('post.table_head.user')}}</th>
                            <th>{{trans('post.table_head.book')}}</th>
                            <th>{{trans('post.table_head.post_type')}}</th>
                            <th>{{trans('post.table_head.body')}}</th>
                            <th>{{trans('post.table_head.rate_point')}}</th>
                            <th>{{trans('post.table_head.status')}}</th>
                            <th>{{trans('post.table_head.options')}}</th>
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
