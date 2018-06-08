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
        $books = new Book;
        if ($request->has('search')) {
            $books->search($request->search);
        }
        $books = $books->with(['category', 'imageBooks'])->get();
        return $this->showAll($books, Response::HTTP_OK);
    }
}
