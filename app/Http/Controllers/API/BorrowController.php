<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\BorrowDetail;
use App\Models\User;
use App\Models\Note;
use Auth;
use App\Http\Requests\Api\BorrowBookRequest;

class BorrowController extends ApiController
{
    /**
     * Api store new borrow
     *
     * @param \App\Http\Requests\CreatePostRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BorrowBookRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $borrow = Borrow::create($input);
        foreach ($request->book as $book) {
            BorrowDetail::create([
                'borrow_id' => $borrow->id,
                'book_id' => $book['id'],
                'quantity' => $book['quantity']
            ]);
        }
        return $this->showOne($borrow->load(['borrowDetails', 'user']), Response::HTTP_OK);
    }

    /**
     * Api get list borrow
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $borrows = Borrow::with(['borrowDetails.book'])->where('user_id', $user->id)->get();
        return $this->showAll($borrows, Response::HTTP_OK);
    }

    /**
     * Api cancel borrow
     *
     * @param \Illuminate\Http\Request $request request
     * @param \App\Models\Borrow       $borrow  borrow of this borrow
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, Borrow $borrow)
    {
        if ($borrow->user_id == Auth::id() && $borrow->status == Borrow::WAITTING) {
            $borrow->status = Borrow::CANCEL;
            $borrow->save();
            Note::create([
                'user_id' => Auth::id(),
                'borrow_id' => $borrow->id,
                'content' => $request->content
            ]);
            return $this->showOne($borrow->load('borrowDetails', 'note'), Response::HTTP_OK);
        }
        return $this->errorResponse(trans('borrow.messages.cancel_borrow_error'), Response::HTTP_UNAUTHORIZED);
    }
}
