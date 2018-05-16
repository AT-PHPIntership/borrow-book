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
            @include('admin.layouts.partials.errors')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="box-body">
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.email')}}</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="{{trans('user.form.placeholders.email')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.password')}}</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="{{trans('user.form.placeholders.password')}}" disabled="">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('user.form.placeholders.name')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.identity_number')}}</label>
                        <input type="text" class="form-control" id="identity_number" name="identity_number" placeholder="{{trans('user.form.placeholders.identity_number')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.dob')}}</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.address')}}</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="{{trans('user.form.placeholders.address')}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.role')}}</label>
                        <select class="form-control" id="role" name="role">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('user.form.title_inputs.avatar')}}</label>
                        <input type="file" id="avatar" name="avatar">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submit" name="submit">{{trans('user.form.buttons.submit')}}</button>
                    <button type="reset" class="btn" id="reset" name="reset">{{trans('user.form.buttons.reset')}}</button>
                </div>
            </form>
          </div>
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
</div>
@endsection
