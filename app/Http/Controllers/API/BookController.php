<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Book;

class BookController extends ApiController
{
   /**
     * Get api list books, search
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::search($request->search);
        return $this->showAll($books, Response::HTTP_OK);
    }
}
