<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Session;
use App\Http\Requests\CreateUserRequest;
use App\Mail\CreateUserMail;
use Mail;

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
        $users = User::findOrFail($id);
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
        $password = str_random(6);
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->name = $request->name;
        $user->identity_number = $request->identity_number;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->role = $request->role;
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $nameNew = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images');
            $user->avatar = $nameNew;
            $user->save();
            $image->move($destinationPath, $nameNew);
        } else {
            $user->avatar = $request->avatar;
            $user->save();
        }
        $data['email'] = $user->email;
        $data['password'] = $password;
        Mail::to($user->email)->send(new CreateUserMail($data));
        Session::flash('message', trans('user.messages.create_success'));
        return redirect()->route('admin.users.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        Session::flash('message', trans('user.messages.delete_success'));
        return redirect()->route('admin.users.index');
    }
}
