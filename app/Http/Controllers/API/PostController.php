<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;
use App\Models\Book;

class PostController extends ApiController
{
    /**
     * Api get list post following book_id
     *
     * @param Models\Book $book book
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostFollowingBook(Book $book)
    {
        $posts = new Post;
        $posts = $posts->with(['user'])->where('book_id', $book->id)->get();
        return $this->successResponse($posts, Response::HTTP_OK);
    }
}
