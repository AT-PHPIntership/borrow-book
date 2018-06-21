<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\BorrowDetail;
use Auth;

class BorrowController extends ApiController
{
    /**
     * Api store new borrow
     *
     * @param \App\Http\Requests\CreatePostRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $borrow = Borrow::create($input);
        foreach ($request->book as $book) {
            BorrowDetail::create([
                'borrow_id' => $borrow->id,
                'book_id' => $book
            ]);
        }
        return $this->showOne($borrow->load(['borrowDetails', 'user']), Response::HTTP_OK);
    }
}
