<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
