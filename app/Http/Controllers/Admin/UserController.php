<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Http\Requests\CreateUserRequest;

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

    /**
    * Show the form for creating a new user.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name_new = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/avatars');
            $image->move($destinationPath, $name_new);
        }
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->identity_number = $request->identity_number;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->avatar = $name_new;
        $user->role = $request->role;
        //$data = $request->all();
        $user -> save();
        //$user = User::create($data);
        // dd($data);
        // redirect
        Session::flash('message', 'Successfully created user!');
        return redirect()->route('admin.users.create');
    }
}
