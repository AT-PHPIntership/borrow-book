<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    /**
     * Display a listing of User.
     *
     * @return users
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', ['users' => $users]);
    }
    /**
     * Show layout of user.
     *
     * @param int $id id of user
     *
     * @return view
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.users.update', ['users' => $users]);
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        $user = User::FindOrFail($id)->update($data); 
        dd($user);
        return redirect()->route('admin.users.index');  
    }
}
