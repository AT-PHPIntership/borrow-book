<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\Favorite;

class FavoriteController extends ApiController
{
    /**
     * Api store new favorite
     *
     * @param Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $favorite = Favorite::create([
            'user_id' => $user->id,
            'book_id' => $request->book_id,
        ]);
        return $this->showOne($favorite, Response::HTTP_OK);
    }

    /**
     * Api get list favorites
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $favorite = Favorite::with(['book'])->where('user_id', $user->id)->get();
        return $this->showAll($favorite, Response::HTTP_OK);
    }

    /**
     * Api update status
     *
     * @param \App\Models\Favorite       $favorite favorite of this favorite
     * @param \App\Http\Requests\Request $request  request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Favorite $favorite, Request $request)
    {
        $user = Auth::user();
        if ($favorite->user_id == $user->id) {
            $favorite['status'] = $request->status;
            $favorite->update();
            return $this->showOne($favorite, Response::HTTP_OK);
        }
        return $this->errorResponse(trans('favorite.messages.update_favorite_error'), Response::HTTP_OK);
    }

    /**
     * Api delete favorite
     *
     * @param Models/Post $favorite favorite
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        if ($favorite->user_id == Auth::id()) {
            $favorite->delete();
            return $this->successResponse($favorite, Response::HTTP_OK);
        } else {
            return $this->errorResponse(trans('favorite.messages.delete_favorite_error'), Response::HTTP_UNAUTHORIZED);
        }
    }
}
