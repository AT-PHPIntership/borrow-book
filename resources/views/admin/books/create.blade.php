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
            <form role="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="box-body">
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.title')}}</label>
                        <input type="file" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.description')}}</label>
                        <div class="form-group">
                            <textarea name="description" id="description" cols="140" rows="10" placeholder="{{trans('book.form.placeholders.description')}}"></textarea>
                        </div>
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
                        <input type="text" class="form-control" id="language" name="language" placeholder="{{trans('book.form.placeholders.language')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('book.form.title_inputs.quantity')}}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{trans('book.form.placeholders.quantity')}}">
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
