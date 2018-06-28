@extends('admin.layouts.admin')

@section('title', trans('book.list_book'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('book.create')}}</h3>
            </div>
            @include('admin.layouts.partials.errors')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="box-body">
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.image')}}</label>
                        <input type="file" name="photos[]" multiple>
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.category')}}</label>
                        <select class="form-control" id="category" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.title')}}</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="{{trans('book.form.placeholders.title')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.number_of_page')}}</label>
                        <input type="number" class="form-control" id="number_of_page" name="number_of_page" placeholder="{{trans('book.form.placeholders.number_of_page')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.author')}}</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="{{trans('book.form.placeholders.author')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.publishing_year')}}</label>
                        <input type="date" class="form-control" id="publishing_year" name="publishing_year">
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.language')}}</label>
                        <select class="form-control" id="language" name="language">
                            @foreach ($languages as $language)
                                <option value="{{ $language }}">{{ $language }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.quantity')}}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{trans('book.form.placeholders.quantity')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.description')}}</label>
                        <div class="form-group">
                            <textarea class="ckeditor" name="description" id="description" cols="140" rows="10" placeholder="{{trans('book.form.placeholders.description')}}"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submit" name="submit">{{trans('book.form.buttons.submit')}}</button>
                    <button type="reset" class="btn" id="reset" name="reset">{{trans('book.form.buttons.reset')}}</button>
                </div>
            </form>
          </div>
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
</div>
@endsection
