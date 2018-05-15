@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{trans('user.create')}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label>{{trans('user.form.title-inputs.email')}}</label>
                        <input type="email" class="form-control" id="email" placeholder="{{trans('user.form.placeholders.address')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title-inputs.password')}}</label>
                        <input type="password" class="form-control" id="password" placeholder="{{trans('user.form.placeholders.address')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title-inputs.fullname')}}</label>
                        <input type="text" class="form-control" id="full-name" placeholder=" {{trans('user.form.placeholders.address')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title-inputs.identity-number')}}</label>
                        <input type="text" class="form-control" id="identity-number" placeholder="{{trans('user.form.placeholders.address')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title-inputs.dob')}}</label>
                        <input type="date" class="form-control" id="dob">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title-inputs.address')}}</label>
                        <input type="text" class="form-control" id="address" placeholder="{{trans('user.form.placeholders.address')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title-inputs.avatar')}}</label>
                        <input type="file" id="avatar">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{trans('user.form.buttons.submit')}}</button>
                    <button type="reset" class="btn">{{trans('user.form.buttons.reset')}}</button>
                </div>
            </form>
          </div>
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
</div>
@endsection
