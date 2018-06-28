<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\Borrow;
use App\Models\Post;
use App\Http\Requests\UpdateUserRequest;
use Session;
use App\Http\Requests\CreateUserRequest;
use App\Mail\CreateUserMail;
use Mail;
use DB;
use Exception;

class UserController extends Controller
{

    /**
     * Display a listing of User.
     *
     * @param Http\Requests\Request $request request
     *
     * @return users
     */
    public function index(Request $request)
    {
        $keyword = $request->search;
        if ($keyword != '') {
            $users = User::where("name", "LIKE", "%$keyword%")
                        ->orWhere("email", "LIKE", "%$keyword%");
            Session::flash('message_search', trans('search.message', ['number' => $users->count()]));
            $users = $users->sortable()->paginate()->appends(['search' => $keyword]);
        } else {
            $users = User::sortable()->paginate();
        }
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
     * Update User.
     *
     * @param Http\Requests\UpdateUserRequest $request request
     * @param App\Models\User                 $id      id of User
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->identity_number = $request->identity_number;
        $user->dob = $request->dob;
        $user->address = $request->address;
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $nameNew = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path(config('image.images_path'));
            $user->avatar = $nameNew;
            $user->save();
            $image->move($destinationPath, $nameNew);
        } else {
            $user->save();
        }
        Session::flash('message_success', trans('user.messages.success.update'));
        return redirect()->route('admin.users.index');
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
            $user->save();
        }
        $data['email'] = $user->email;
        $data['password'] = $password;
        Mail::to($user->email)->send(new CreateUserMail($data));
        Session::flash('message_success', trans('user.messages.success.create'));
        return redirect()->route('admin.users.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param App\Models\User $user data of user want to delete
    *
    * @return Response
    */
    public function destroy(User $user)
    {
        if ($user->role == User::ROLE_USER) {
            DB::beginTransaction();
            try {
                $user->ratings()->delete();
                $user->favorites()->delete();
                $user->posts()->delete();
                $borrowes = Borrow::where('user_id', $user->id)->get();
                foreach ($borrowes as $borrow) {
                    if ($borrow->status != Borrow::BORROWING) {
                        $borrow->borrowDetails()->delete();
                        $borrow->delete();
                    } else {
                        throw new Exception();
                    }
                }
                $user->delete();
                DB::commit();
                Session::flash('message_success', trans('user.messages.success.delete'));
            } catch (Exception $e) {
                DB::rollback();
                Session::flash('message_fail', trans('user.messages.fail.delete'));
            }
        }
        return redirect()->route('admin.users.index');
    }

    /**
    * Show the user detail and history borrow.
    *
    * @param User $user object user
    *
    * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        $borrowes = Borrow::with('borrowDetails.book')
                        ->where('user_id', $user->id)
                        ->orderBy('status', 'asc')->get();
        return view('admin.users.show', compact('user', 'borrowes'));
    }
}
