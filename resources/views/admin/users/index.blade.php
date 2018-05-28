@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>{{trans('user.list_user')}}</h2>
        <h4><a href="{{route('admin.users.create')}}"><i class="fa fa-plus"> {{trans('user.create')}}</i></a></h4>
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
                <table id="table-index" class="table table-striped box">
                    <thead>
                        <tr>
                            <th>{{trans('user.table_head.avatar')}}</th>
                            <th>{{trans('user.table_head.name')}}</th>
                            <th>{{trans('user.table_head.email')}}</th>
                            <th>{{trans('user.table_head.options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img class="text-center" src="{{ $user->avatar_url }}" alt=""></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 0)
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-flat fa fa-pencil button-edit"></a>&nbsp;&nbsp;
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline form-delete">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-flat fa fa-trash-o btn-delete-item button-delete" onclick="return confirm('{{trans('user.messages_confirm.confirm_delete')}}')"></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
