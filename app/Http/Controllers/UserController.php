<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function listUser() {
        $users = User::all();
        return view ('admin.user', ['users' => $users]);
    }
}
