@extends('admin.layouts.admin')

@section('title', trans('post.title'))

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3>{{trans('post.list_post')}}</h3>
    </section>
    @include('admin.layouts.partials.errors')
    @include('admin.layouts.partials.messages')

    <!-- Main content -->
    <section class="container">
        <div class="row">
            <div class="col-md-10">
                <table class="table box">
                    <thead>
                        <tr>
                            <th>{{trans('post.table_head.user')}}</th>
                            <th>{{trans('post.table_head.book')}}</th>
                            <th>{{trans('post.table_head.post_type')}}</th>
                            <th>{{trans('post.table_head.body')}}</th>
                            <th>{{trans('post.table_head.rate_point')}}</th>
                            <th>{{trans('post.table_head.status')}}</th>
                            <th>{{trans('post.table_head.options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post )
                        <tr>
                            <td>{{ $post->name }}</td>
                            <td>{{ $post->title }}</td>
                            @if($post->post_type ===0 )
                                <td>{{trans('post.comment')}}</td>
                            @else
                                <td>{{trans('post.review')}}</td>
                            @endif
                            <td>{{ $post->body }}</td>
                            <td>{{ $post->rate_point }}</td>
                            <td>
                                @if($post->status === 1)
                                <a href=""><i class="btn btn-success fa fa-check"></i></a>
                                @else
                                <a href=""><i class="btn btn-danger fa fa-close"></i></a>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-flat fa fa-trash-o btn-delete-item" onclick="return confirm('{{trans('post.messages.confirm_delete')}}')">
                                    </button>
                                </form> 
                            </td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
