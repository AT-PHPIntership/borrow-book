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
        $data['users'] = User::count();
        $data['books'] = Book::count();
        $data['posts'] = Post::count();
        $data['borrowes'] = Borrow::count();
        $lastWeek = new Carbon('last week');
        $data['usersLastWeek'] = User::where('created_at', '>', $lastWeek)->count();
        $data['booksLastWeek'] = Book::where('created_at', '>', $lastWeek)->count();
        $data['postsLastWeek'] = Post::where('created_at', '>', $lastWeek)->count();
        $data['borrowesLastWeek'] = Borrow::where('created_at', '>', $lastWeek)->count();
        $lastMonth = new Carbon('last month');
        $data['usersLastMonth'] = User::where('created_at', '>', $lastMonth)->count();
        $data['booksLastMonth'] = Book::where('created_at', '>', $lastMonth)->count();
        $data['postsLastMonth'] = Post::where('created_at', '>', $lastMonth)->count();
        $data['borrowesLastMonth'] = Borrow::where('created_at', '>', $lastMonth)->count();
        $data['topBookMonthly'] = DB::table('borrow_details')
                                ->select('books.title AS name', \DB::raw("COUNT('book_id') AS number_borrow"))
                                ->join('books', 'books.id', '=', 'borrow_details.book_id')
                                ->where('borrow_details.created_at', '>', $lastMonth)
                                ->orderBy('number_borrow', 'desc')
                                ->groupBy('book_id')
                                ->take(10)
                                ->get();
        return view('admin.index', $data);
    }
}
