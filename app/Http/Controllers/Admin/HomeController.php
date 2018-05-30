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
     * Display a listing of User.
     *
     * @return users
     */
    public function index()
    {
        $data['users'] = User::all();
        $data['books'] = Book::all();
        $data['posts'] = Post::all();
        $data['borrowes'] = Borrow::all();
        $lastweek = new Carbon('last week');
        $data['usersLastWeek'] = User::where('created_at', '>', $lastweek);
        $data['booksLastWeek'] = Book::where('created_at', '>', $lastweek);
        $data['postsLastWeek'] = Post::where('created_at', '>', $lastweek);
        $data['borrowesLastWeek'] = Borrow::where('created_at', '>', $lastweek);
        $lastmonth = new Carbon('last month');
        $data['usersLastMonth'] = User::where('created_at', '>', $lastmonth);
        $data['booksLastMonth'] = Book::where('created_at', '>', $lastmonth);
        $data['postsLastMonth'] = Post::where('created_at', '>', $lastmonth);
        $data['borrowesLastMonth'] = Borrow::where('created_at', '>', $lastmonth);
        $data['topBookMonthly'] = DB::table('borrow_details')
                                ->select('books.title AS name', \DB::raw("COUNT('book_id') AS numberOfBorrow"))
                                ->join('books', 'books.id', '=', 'borrow_details.book_id')
                                ->where('borrow_details.created_at', '>', $lastmonth)
                                ->orderBy('numberOfBorrow', 'desc')
                                ->groupBy('book_id')
                                ->take(10)
                                ->get();
        //dd($data['topBookMonthly']);
        return view('admin.index', $data);
    }
}
