<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
     * @param Http\Requests\CreateUserRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $nameNew = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images');

            $password = str_random(6);
            $user = new User;
            $user->email = $request->email;
            $user->password = bcrypt($password);
            $user->name = $request->name;
            $user->identity_number = $request->identity_number;
            $user->dob = $request->dob;
            $user->address = $request->address;
            $user->avatar = $nameNew;
            $user->role = $request->role;
            $user->save();

            $image->move($destinationPath, $nameNew);
        }
        Session::flash('message', trans('user.messages.create_success'));
        return redirect()->route('admin.users.index');
    }
}
