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
        Session::flash('message', trans('book.messages.create_success'));
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
        $book = Book::with(['category', 'imageBooks'])->findOrFail($id);
        $languages = Book::LANGUAGES;
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories', 'languages'));
    }

    /**
     * Update User.
     *
     * @param Http\Requests\UpdateUserRequest $request request
     * @param App\Models\User                 $id      id of User
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBookRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $book = Book::findOrFail($id);
            $book->update($request->all());
            if ($request->hasFile('photos')) {
                ImageBook::where('book_id', $book->id)->delete();
                foreach ($request->file('photos') as $photo) {
                    $nameNew = time().'.'.$photo->getClientOriginalExtension();
                    $photo->move(public_path(config('image.images_path')), $nameNew);
                    ImageBook::create([
                        'book_id' => $book->id,
                        'image' => $nameNew
                    ]);
                }
            }
        });
        Session::flash('message', trans('book.messages.update_success'));
        return redirect()->route('admin.books.index');
    }
}
