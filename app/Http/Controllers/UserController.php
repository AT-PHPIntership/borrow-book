<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{

    /**
     * Display a listing of User.
     *
     * @return users
     */
    public function listUser()
    {
        $users = User::all();
        return view('admin.user', ['users' => $users]);
    }
}
