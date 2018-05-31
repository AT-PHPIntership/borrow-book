@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>{{trans('user.list_user')}}</h2>
        <h4><a class="btn btn-primary" href="{{route('admin.users.create')}}"><i class="fa fa-plus"> {{trans('user.create')}}</i></a></h4>
    </section>
    <hr>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="search-container">
                    <form action="{{route('admin.users.index')}}" method="GET">
                        <input type="text" placeholder="Search" name="search">
                        <button type="submit" class="button-search-user"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                @include('admin.layouts.partials.message_search')
                <table id="table-index" class="table table-striped box">
                    <thead>
                        <tr>
                            <th>{{trans('user.table_head.avatar')}}</th>
                            <th id="link-sort-name">@sortablelink('name', trans('user.table_head.name'))</th>
                            <th id="link-sort-email">@sortablelink('email', trans('user.table_head.email'))</th>
                            <th>{{trans('user.table_head.options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td><img class="text-center img-style" src="{{ $user->avatar_url }}" alt=""></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 0)
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-flat fa fa-pencil button-edit"></a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline form-delete">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-flat fa fa-trash-o btn-delete-item button-delete" onclick="return confirm('{{trans('user.messages.confirm.delete')}}')"></button>
                                </form>
                                @endif
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary btn-flat fa fa-info button-info"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $users->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
