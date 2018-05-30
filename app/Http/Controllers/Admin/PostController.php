<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Session;

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
            'posts.id',
            'posts.user_id',
            'posts.book_id',
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

    /**
     * Delete a post
     *
     * @param Post $post object post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            Session::flash('message_success', trans('post.messages.delete_post_success'));
        } catch (Exception $e) {
            Session::flash('message_fail', trans('post.messages.delete_post_error'));
        }
        return redirect()->back();
    }
    /**
     * Update status of posts
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        $post = Post::findOrFail($request->idPost);
        $post->update(['status' => !$post->status]);
        return response()->json([
            "status" => $post->status
        ]);
    }
}
