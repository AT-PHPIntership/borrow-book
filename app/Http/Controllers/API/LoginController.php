<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Http\Requests\Api\RegisterRequest;
use Auth;
use Validator;

class LoginController extends ApiController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $data = Auth::user();
            $token =  $data->createToken('MyApp')->accessToken;
            $status = Response::HTTP_OK;
            return response()->json(compact('status', 'token', 'data'), Response::HTTP_OK);
        } else {
            return response()->json(['error' => 'Unauthorised'], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Register api
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        return response()->json(['success' => $success], Response::HTTP_OK);
    }
}
