@extends('admin.layouts.admin')

@section('title', trans('category.title'))

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
            <div class="col-md-6">
                <div class="form-group">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"><input type="hidden" name="_token" value="{{csrf_token()}}">
                        <label>{{ trans('category.form.title_inputs.name') }}</label>
                        <input type="text" placeholder="{{ trans('category.placeholders.name') }}" name="name">
                        <button class="btn btn-primary"><i class="fa fa-plus"> {{trans('user.create')}}</i></button>
                    </form>
                </div>
                @include('admin.layouts.partials.errors')
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
