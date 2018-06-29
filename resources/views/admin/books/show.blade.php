@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>{{trans('book.detail_book')}}</h2>
      </section>
      <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-6">
               <div class="box box-primary">
                    <div class="box-body box-profile">
                        @foreach ($book->imageBooks as $imageBook)
                        <div class="img-wrap">
                            <img id="image{{ $imageBook->id }}" class="text-center img-style" src="{{ $imageBook->image_url }}" alt="">
                        </div>
                        @endforeach
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.title')}}</b> <p class=" title pull-right">{{ $book->title }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.number_of_page')}}</b> <p class="pull-right">{{ $book->number_of_page }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.author')}}</b> <p class="author pull-right">{{ $book->author }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.publishing_year')}}</b> <p class="publishing-year pull-right">{{ $book->publishing_year }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.language')}}</b> <p class="language pull-right">{{ $book->language }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.quantity')}}</b> <p class="pull-right">{{ $book->quantity }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.category')}}</b> <p class="category pull-right">{{ $book->category->name }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('book.form.title_inputs.description')}}</b> <p class="description">{!! $book->description !!}</p>
                            </li>
                        </ul>
                        <a href="javascript:history.back()" class="btn btn-primary btn-block"><b>{{ trans('book.form.buttons.back') }}</b></a>
                    </div>
                   <!-- /.box-body -->
               </div>
            </div>
        </div>
    </section>
</div>
@endsection
