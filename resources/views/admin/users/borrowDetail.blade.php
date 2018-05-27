@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>{{trans('user.user_detail_borrow')}}</h2>
    </section>
    <hr>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-body">
                        <img src="" alt="">
                        <p class="text-muted">{{trans('user.table_head.name')}}</p>
                        <p class="text-muted">{{trans('user.table_head.email')}}</p>
                        <p class="text-muted">{{trans('user.table_head.identity_number')}}</p>
                        <p class="text-muted">{{trans('user.table_head.dob')}}</p>
                        <p class="text-muted">{{trans('user.table_head.address')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
