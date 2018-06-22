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
use DB;

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
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['user'] =  $user;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Check access token api
     *
     * @param \Illuminate\Auth\AuthenticationException $exception exception
     *
     * @return \Illuminate\Http\Response
     */
    public function checkAccessToken(AuthenticationException $exception)
    {
        if (Auth::user()) {
            $user = Auth::user();
            return response()->json($user);
        } else {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Logout
     *
     * @return 204
     */
    public function logout()
    {
        $user = Auth::user();
        $accessToken = $user->token();
        $accessToken->revoke();
        return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }
}
