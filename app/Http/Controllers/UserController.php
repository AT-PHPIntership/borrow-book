<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    /**
     * Show profile user
     *
     * @return view
     */
    public function index()
    {
        return view('user.profile.index');
    }
}
