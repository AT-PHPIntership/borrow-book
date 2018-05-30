<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Borrow;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows = Borrow::with(['user'])->paginate();
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
        return response()->json($borrow);
    }
}
