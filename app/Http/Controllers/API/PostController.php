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
use App\Http\Requests\PostRequest;

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
        $posts = $posts->with(['user'])->where('book_id', $book->id)->where('status', Post::ACCEPT)->get();
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
        $book = Book::findOrFail($post->book_id);
        if ($post->user_id == Auth::id()) {
            if ($post->post_type == Post::REVIEW) {
                if ($book->total_rate != 0 && $book->count_rate != 0) {
                    $book->total_rate -= $post->rate_point;
                    $book->count_rate -= 1;
                    $book->save();
                }
            }
            $post->delete();
            return $this->showOne($post->load(['user']), Response::HTTP_OK);
        } else {
            return $this->errorResponse(trans('post.messages.delete_post_error'), Response::HTTP_UNAUTHORIZED);
        }
    }
    
    /**
     * Api store new post
     *
     * @param \App\Models\Book               $book    book of this post
     * @param \App\Http\Requests\PostRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Book $book, PostRequest $request)
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
            } else {
                $input['rate_point'] = 0;
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

    /**
     * Api update post
     *
     * @param \App\Models\Post               $post    post of this post
     * @param \App\Http\Requests\PostRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, PostRequest $request)
    {
        $book = Book::findOrFail($post->book_id);
        if ($post->user_id == Auth::id()) {
            $input = $request->only('post_type', 'body');
            if ($input['post_type'] == Post::REVIEW) {
                $input['rate_point'] = $request->rate_point;
                $book->total_rate -= $post->rate_point;
                $book->total_rate += $request->rate_point;
                $book->save();
            }
            $input['status'] = Post::UNACCEPT;
            $post->update($input);
            return $this->showOne($post->load('user'), Response::HTTP_OK);
        }
        return $this->errorResponse(trans('post.messages.update_post_error'), Response::HTTP_OK);
    }
}
