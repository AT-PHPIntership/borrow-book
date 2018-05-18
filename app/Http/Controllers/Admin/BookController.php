<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\ImageBook;
use Session;

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
        $categories = Category::all();
        return view('admin.books.create', compact('categories', $categories));
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
        $data = $request->only([
            'category_id',
            'title',
            'description',
            'number_of_page',
            'author',
            'publishing_year',
            'language',
            'quantity'
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
        Session::flash('message', trans('book.messages.create_success'));
        return redirect()->route('admin.books.index');
    }
}
