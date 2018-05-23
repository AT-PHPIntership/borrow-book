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
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search" name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <table class="table table-striped box">
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
                            <td><img class="text-center" src="{{ $user->avatar_url }}" alt=""></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button>
                                     <a href="{{ route('admin.users.edit', $user->id) }}">{{trans('user.form.buttons.edit')}}</a>
                                </button> 
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button onclick="return confirm('{{trans('user.messages.confirm_delete')}}')">{{trans('user.form.buttons.delete')}}</button>
                                </form>
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
