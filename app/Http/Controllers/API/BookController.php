<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Http\Requests\Api\RegisterRequest;
use Auth;
use App\Models\Book;

class BookController extends ApiController
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $book = Book::all();
	    return $this->showAll($book);
	}
}

