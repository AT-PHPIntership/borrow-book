@extends('admin.layouts.admin')

@section('title', trans('book.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('borrow.list_borrow')}}</h3>
    </section>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <table class="table box">
                    <thead>
                        <tr>
                            <th>{{trans('borrow.table_head.avatar')}}</th>
                            <th>{{trans('borrow.table_head.borrower')}}</th>
                            <th>{{trans('borrow.table_head.number_book')}}</th>
                            <th>{{trans('borrow.table_head.from_date')}}</th>
                            <th>{{trans('borrow.table_head.to_date')}}</th>
                            <th>{{trans('borrow.table_head.status')}}</th>
                            <th>{{trans('borrow.table_head.options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td><img class="text-center img-style" src="{{ $borrow->user->avatar_url}}" alt=""></td>
                                <td>{{ $borrow->user->name }}</td>
                                <td>{{ $borrow->borrowDetails->sum('quantity') }}</td>
                                <td>{{ date('d-m-Y', strtotime($borrow->from_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($borrow->to_date)) }}</td>
                                <td>
                                    <select class="form-control status" name="status" data-id="{{ $borrow->id }}">
                                        <option value="{{ App\Models\Borrow::BORROWING }}" {{ $borrow->status == App\Models\Borrow::BORROWING ? 'selected="selected" disabled' : '' }}>{{ trans('borrow.status.borrowing') }}</option>
                                        <option value="{{ App\Models\Borrow::GIVE_BACK }}" {{ $borrow->status == App\Models\Borrow::GIVE_BACK ? 'selected="selected" disabled' : '' }}>{{ trans('borrow.status.give_back') }}</option>
                                        <option value="{{ App\Models\Borrow::WAITTING }}" {{ $borrow->status == App\Models\Borrow::WAITTING ? 'selected="selected" disabled' : '' }}>{{ trans('borrow.status.waitting') }}</option>
                                        <option value="{{ App\Models\Borrow::CANCEL }}" {{ $borrow->status == App\Models\Borrow::CANCEL ? 'selected="selected" disabled' : '' }}>{{ trans('borrow.status.cancel') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="{{ route('admin.borrows.show', $borrow->id) }}" class="btn btn-primary btn-flat fa fa-info button-info"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $borrows->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
    <script src="js/updateStatusBorrow.js"></script>
@endsection
