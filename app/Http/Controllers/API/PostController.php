<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;
use App\Models\Book;
use App\Models\User;
use Auth;
use DB;

class PostController extends ApiController
{
    /**
     * Api get list post following book_id
     *
     * @param Illuminate\Http\Request $request request
     * @param Models\Book             $book    book
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostFollowingBook(Request $request, Book $book)
    {
        $posts = new Post;
        if ($request->has('post_type')) {
            $posts = $posts->postType($request->post_type);
        }
        $posts = $posts->with(['user'])->where('book_id', $book->id)->get();
        return $this->showAll($posts, Response::HTTP_OK);
    }

    /**
     * Api delete post
     *
     * @param Models/Post $post post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id == Auth::id()) {
            $post->delete();
            return $this->showOne($post->load('user'), Response::HTTP_OK);
        } else {
            return $this->errorResponse("Can not delete this comment!", Response::HTTP_OK);

        }
    }
}
