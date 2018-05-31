<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\BorrowDetail;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Display data in statistical page.
     *
     * @return data
     */
    public function index()
    {
        $data['users'] = User::all();
        $data['books'] = Book::all();
        $data['posts'] = Post::all();
        $data['borrowes'] = Borrow::all();
        $lastWeek = new Carbon('last week');
        $data['usersLastWeek'] = User::where('created_at', '>', $lastWeek);
        $data['booksLastWeek'] = Book::where('created_at', '>', $lastWeek);
        $data['postsLastWeek'] = Post::where('created_at', '>', $lastWeek);
        $data['borrowesLastWeek'] = Borrow::where('created_at', '>', $lastWeek);
        $lastMonth = new Carbon('last month');
        $data['usersLastMonth'] = User::where('created_at', '>', $lastMonth);
        $data['booksLastMonth'] = Book::where('created_at', '>', $lastMonth);
        $data['postsLastMonth'] = Post::where('created_at', '>', $lastMonth);
        $data['borrowesLastMonth'] = Borrow::where('created_at', '>', $lastMonth);
        $data['topBookMonthly'] = DB::table('borrow_details')
                                ->select('books.title AS name', \DB::raw("COUNT('book_id') AS numberOfBorrow"))
                                ->join('books', 'books.id', '=', 'borrow_details.book_id')
                                ->where('borrow_details.created_at', '>', $lastMonth)
                                ->orderBy('numberOfBorrow', 'desc')
                                ->groupBy('book_id')
                                ->take(10)
                                ->get();
        return view('admin.index', $data);
    }
}
