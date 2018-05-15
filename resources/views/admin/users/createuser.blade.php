@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create user</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Full name</label>
                        <input type="text" class="form-control" id="full-name" placeholder="Enter Full name">
                    </div>
                    <div class="form-group">
                        <label>Identity number</label>
                        <input type="text" class="form-control" id="identity-number" placeholder="Enter Identity number">
                    </div>
                    <div class="form-group">
                        <label>Birthday</label>
                        <input type="date" class="form-control" id="dob">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" id="avatar">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </form>
          </div>
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
</div>
@endsection
