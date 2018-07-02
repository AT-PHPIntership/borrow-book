<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\Book;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows = Borrow::with(['user', 'borrowDetails'])->paginate();
        return view('admin.borrows.index', compact('borrows'));
    }

    /**
     * Update status of borrow
     *
     * @param \Illuminate\Http\Request $request request
     * @param \App\Models\Borrow       $borrow  borrow
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Borrow $borrow)
    {
        $borrow['status'] = $request->status;
        $borrow->save();
        foreach ($borrow->borrowDetails as $borrowDetail) {
            $book = Book::where('id', $borrowDetail->book_id)->first();
            if ($request->status == Borrow::BORROWING) {
                $book['quantity'] = $book->quantity - $borrowDetail->quantity;
            } elseif ($request->status == Borrow::GIVE_BACK) {
                $book['quantity'] = $book->quantity + $borrowDetail->quantity;
            }
            $book->save();
        }
        return response()->json($borrow);
    }

    public function show(Borrow $borrow)
    {
        $borrow->load('user', 'borrowDetails.book');
        return view('admin.borrows.show', compact('borrow'));
    }
}
