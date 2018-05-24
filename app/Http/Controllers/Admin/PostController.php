<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Show layout of post.
     *
     * @return view
     */
    public function index()
    {
        return view('admin.posts.index');
    }
}
