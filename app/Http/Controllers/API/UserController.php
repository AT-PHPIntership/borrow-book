<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\Post;

class UserController extends ApiController
{
    /**
     * Api get list post following user
     *
     * @return \Illuminate\Http\Response
     */
    public function getPost()
    {
        $post = new Post();
        $user = Auth::user();
        $data = $post->with('book')->where('user_id', $user->id)->get();
        return $this->showAll($data, Response::HTTP_OK);
    }

    /**
     * Get user profile
     *
     * @return json user
     */
    public function profile()
    {
        $data['data'] = Auth::user();
        return $this->successResponse($data, Response::HTTP_OK);
    }
}
