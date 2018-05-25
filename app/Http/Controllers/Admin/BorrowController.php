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
     * Display the specified resource.
     *
     * @param Borrow $borrow borrow
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        return view('admin.borrows.show', compact('borrow'));
    }
}
