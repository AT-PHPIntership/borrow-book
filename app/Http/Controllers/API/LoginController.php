<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Auth\AuthenticationException;
use Auth;
use Validator;

class LoginController extends ApiController
{
    /**
     * Login api
     *
     * @param \Illuminate\Auth\AuthenticationException $exception exception
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AuthenticationException $exception)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token =  $user->createToken(config('app.name'))->accessToken;
            $status = Response::HTTP_OK;
            $data['status'] = $status;
            $data['token'] = $token;
            $data['user'] = $user;
            return response()->json($data, $status);
        } else {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_UNAUTHORIZED);
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
