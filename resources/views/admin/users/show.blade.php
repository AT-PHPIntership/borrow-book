@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>{{trans('user.user_detail')}}</h2>
    </section>
    <hr>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar_url }}">
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.email')}}</b> <p class="pull-right">{{ $user->email }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.identity_number')}}</b> <p class="pull-right">{{ $user->identity_number }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.dob')}}</b> <p class="pull-right">{{ $user->dob }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.address')}}</b> <p class="pull-right">{{ $user->address }}</p>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-5">
                @foreach($borrowes as $borrow)
                <div class="box box-primary">
                    <div class="box-body">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.from_date')}}</b> <p class="pull-right">{{ $borrow->form_date }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.to_date')}}</b> <p class="pull-right">{{ $borrow->to_date }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.book_name')}}</b>
                                @foreach ($borrow->borrowDetails as $borrowDetail)
                                    <a href="">{{ $borrowDetail->book->title }}</a><span>&sbquo; </span>
                                @endforeach
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.status')}}</b>
                                @if($borrow->status == App\Models\Borrow::BORROWING)
                                    <p class="pull-right label label-primary" >{{trans('borrow.status.borrowing')}}</p>
                                @elseif($borrow->status == App\Models\Borrow::GIVE_BACK)
                                    <p class="pull-right label label-success">{{trans('borrow.status.give_back')}}</p>
                                @else
                                    <p class="pull-right label label-danger">{{trans('borrow.status.waitting')}}</p>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
