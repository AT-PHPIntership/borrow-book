@extends('admin.layouts.admin')

@section('title', trans('category.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('category.list_category')}}</h3>
    </section>
    @include('admin.layouts.partials.messages')
    <div class="success-update hidden"></div>
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
                                <td id="{{ $category->id }}">{{ $category->name }}</td>
                                <td>
                                    <button class="btn btn-primary btn-flat fa fa-pencil button-edit-category" data-category="{{ $category }}"></button>&nbsp;&nbsp;
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
                    {{ $categories->links() }}
                </div>
            </div>
            <div class="col-md-6 create-category">
                <h3>{{ trans('category.create') }}</h3>
                <div class="form-group">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <label>{{ trans('category.form.title_inputs.name') }}</label>
                        <input type="text" placeholder="{{ trans('category.placeholders.name') }}" name="name" value="{{ old('name') }}">
                        <button class="btn btn-primary"><i class="fa fa-plus"> {{trans('category.buttons.create')}}</i></button>
                    </form>
                </div>
                @include('admin.layouts.partials.errors')
            </div>
            <div class="col-md-6 update-category hidden">
                <h3>{{ trans('category.update') }}</h3>
                <form role="form" action="" class="form-edit-category" method="POST">
                    {{method_field('PATCH')}}
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>{{trans('category.form.title_inputs.name')}}</label>
                            <input type="text" class="form-control" id="category-update" placeholder=" {{trans('category.placeholders.name')}}" value="" name="categoryName">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="update-btn" class="btn btn-primary">{{trans('category.buttons.update')}}</button>
                        <button type="reset" class="btn">{{trans('category.buttons.reset')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
    <script src="js/updateCategory.js"></script>
@endsection
