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
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-flat fa fa-pencil"></a>&nbsp;&nbsp;
                                    <form method="POST" action="" class="inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger btn-flat fa fa-trash-o btn-delete-item"
                                        onclick="return confirm('{{trans('category.messages.confirm_delete')}}')">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
