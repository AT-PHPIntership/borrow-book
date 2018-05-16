<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{

    /**
     * Display a listing of User.
     *
     * @return users
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }
    public function edit($id)
    {
        return view('admin.users.update');
    }
    
}
