<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;
use App\Models\Book;
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
     * @param Model/Post $post post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Post $post)
    {
        DB::beginTransaction();
        try {
            $post->delete();
            DB::commit();
            return $this->responseDeleteSuccess(Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            throw new ModelNotFoundException();
        }
    }
}
