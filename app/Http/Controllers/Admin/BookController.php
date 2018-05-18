<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('imageBooks')->paginate();
        return view('admin.books.index', compact('books', $books));
    }

    /**
     * Show layout of book.
     *
     * @param int $id id of book
     *
     * @return view
     */
    public function edit($id)
    {
        $book = Book::with(['category', 'imageBooks'])->findOrFail($id);
        $categories = Category::all();
        $data = compact('book', 'categories');
        return view('admin.books.edit', $data);
    }
}
