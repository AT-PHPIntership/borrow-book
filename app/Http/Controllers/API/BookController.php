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
        $books = Book::with(['category', 'imageBooks'])
                ->whereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', "%$request->search%");
                })
                ->orWhere('title', 'like', "%$request->search%")
                ->orWhere('author', 'like', "%$request->search%")
                ->orWhere('language', 'like', "%$request->search%")
                ->get();
        return $this->showAll($books, Response::HTTP_OK);
    }
}
