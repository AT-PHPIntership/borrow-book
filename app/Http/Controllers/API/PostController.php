<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;
use App\Models\Book;
use App\Http\Requests\CreatePostRequest;
use Auth;
use DB;
use App\Models\User;

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
     * Api store new post
     *
     * @param \App\Models\Book                     $book    book of this post
     * @param \App\Http\Requests\CreatePostRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Book $book, CreatePostRequest $request)
    {
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $input = $request->only('post_type', 'body');
            if ($input['post_type'] == Post::REVIEW) {
                $input['rate_point'] = $request->rate_point;
                $book->total_rate += $request->rate_point;
                $book->count_rate += 1;
                $book->save();
            }
            $input['user_id'] = $user->id;
            $input['book_id'] = $book->id;
            $input['status'] = Post::UNACCEPT;
            $post = Post::create($input);
            DB::commit();
            return $this->showOne($post->load('user'), Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            throw new ModelNotFoundException();
        }
    }
}
