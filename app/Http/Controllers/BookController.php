<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Show All Books
     *
     * @return view
     */
    public function index()
    {
        return view('user.books.index');
    }

    /**
     * Show view detail book
     *
     * @param Models/Book $book book
     *
     * @return view
     */
    public function show(Book $book)
    {
        return view('user.books.show', $book);
    }
}
