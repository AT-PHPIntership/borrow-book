<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\ImageBook;
use Session;
use DB;
use Exception;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Http\Requests\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        if ($keyword != '') {
            $books = Book::with('imageBooks')->where("title", "LIKE", "%$keyword%")
                        ->orWhere("author", "LIKE", "%$keyword%")
                        ->orWhere("language", "LIKE", "%$keyword%");
            Session::flash('message_search', trans('search.message', ['number' => $books->count()]));
            $books = $books->sortable()->paginate()->appends(['search' => $keyword]);
        } else {
            $books = Book::with('imageBooks')->sortable()->paginate();
        }
        return view('admin.books.index', compact('books'));
    }

    /**
    * Show the form for creating a new user.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $languages = Book::LANGUAGES;
        $categories = Category::all();
        return view('admin.books.create', compact('categories', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Http\Requests\CreateBookRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->except([
                'count_rate'
            ]);

            $book = Book::create($data);
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $nameNew = time().'.'.$photo->getClientOriginalExtension();
                    $photo->move(public_path(config('image.images_path')), $nameNew);
                    ImageBook::create([
                        'book_id' => $book->id,
                        'image' => $nameNew
                    ]);
                }
            } else {
                ImageBook::create([
                    'book_id' => $book->id
                ]);
            }
        });
        Session::flash('message_success', trans('book.messages.create_success'));
        return redirect()->route('admin.books.index');
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
        $book = Book::with('imageBooks')->findOrFail($id);
        $languages = Book::LANGUAGES;
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories', 'languages'));
    }

    /**
     * Update Book.
     *
     * @param Http\Requests\UpdateUserRequest $request request
     * @param App\Models\Book                 $book    book
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBookRequest $request, Book $book)
    {
        DB::transaction(function () use ($request, $book) {
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $nameNew = time().str_random(8).'.'.$photo->getClientOriginalExtension();
                    $photo->move(public_path(config('image.images_path')), $nameNew);
                    ImageBook::create([
                        'book_id' => $book->id,
                        'image' => $nameNew
                    ]);
                }
            }
            $book->update($request->all());
        });
        Session::flash('message_success', trans('book.messages.update_success'));
        return redirect()->route('admin.books.index');
    }
    /**
     * Delete a book and relationship.
     *
     * @param Book $book object book
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        DB::beginTransaction();
        try {
            $book->delete();
            $book->ratings()->delete();
            $book->borrowDetails()->delete();
            $book->favorites()->delete();
            $book->posts()->delete();
            $book->imageBooks()->delete();
            DB::commit();
            Session::flash('message_success', trans('book.messages.delete_book_success'));
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('message_fail', trans('book.errors.delete_book_fail'));
        }
        return redirect()->back();
    }

     /**
     * Display the detail of book.
     *
     * @param int $id id of book
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with(['category','imageBooks'])->findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Find Book.
     *
     * @param Http\Requests\UpdateUserRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function readBarcode(Request $request)
    {
        $book = Book::with('borrowDetails')->where('barcode', $request->barcode)->get();
        return response()->json($book);
    }
}
