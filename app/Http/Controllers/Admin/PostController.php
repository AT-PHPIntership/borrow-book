<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a list of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = [
            'users.name',
            'books.title',
            'posts.post_type',
            'posts.body',
            'posts.rate_point',
            'posts.status',
        ];
        $posts = Post::select($fields)
                    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                    ->leftJoin('books', 'posts.book_id', '=', 'books.id')
                    ->paginate();
        return view('admin.posts.index', compact('posts'));
    }
}
