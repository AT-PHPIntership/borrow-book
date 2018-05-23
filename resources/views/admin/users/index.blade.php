@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('user.list_user')}}</h3>
    </section>
    @include('admin.layouts.partials.messages')
    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
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
                            <td><img class="text-center" src="{{ $user->avatar_url}}" alt=""></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            @if($user->role == 0)
                                <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary btn-flat fa fa-pencil"></a>&nbsp;&nbsp;
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-flat fa fa-trash-o btn-delete-item" onclick="return confirm('{{trans('user.messages_confirm.confirm_delete')}}')">
                                    </button>
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
