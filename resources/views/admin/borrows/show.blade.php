@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>{{ trans('borrow.borrow_detail') }}</h2>
      </section>
      <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-6">
               <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="img-style">
                            <img class="text-center" src="{{ $borrow->user->avatar_url }}" alt="">
                        </div>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{ trans('user.table_head.name') }}</b> <a href="{{ route('admin.users.show', $borrow->user->id) }}"><p class=" title pull-right">{{ $borrow->user->name }}</p></a>
                            </li>
                            <li class="list-group-item">
                                <b>{{trans('user.table_head.status')}}</b>
                                @if($borrow->status == App\Models\Borrow::BORROWING)
                                    <p class="pull-right label label-primary" >{{trans('borrow.status.borrowing')}}</p>
                                @elseif($borrow->status == App\Models\Borrow::GIVE_BACK)
                                    <p class="pull-right label label-success">{{trans('borrow.status.give_back')}}</p>
                                @elseif($borrow->status == App\Models\Borrow::WAITTING)
                                    <p class="pull-right label label-warning">{{trans('borrow.status.waitting')}}</p>
                                @else
                                    <p class="pull-right label label-danger">{{trans('borrow.status.cancel')}}</p>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('borrow.table_head.from_date') }}</b> <p class=" title pull-right">{{ $borrow->from_date }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('borrow.table_head.to_date') }}</b> <p class=" title pull-right">{{ $borrow->to_date }}</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('book.list_book') }}</b>
                                @foreach($borrow->borrowDetails as $borrowDetail)
                                <div>
                                    <p class="text-right"><b>{{ $borrowDetail->book->title }}</b> <span>{{ trans('borrow.quantity') }} {{ $borrowDetail->quantity }}</span></p>
                                    <p class="text-right"></p>
                                </div>
                                @endforeach
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
