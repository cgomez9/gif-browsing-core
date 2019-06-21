<?php

namespace App\Http\Controllers\Api;

use App\FavoriteGif;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteGifController extends Controller
{
    /**
     * @return FavoriteGif[]
     */
    public function index()
    {
        $userId = auth()->user()->getAuthIdentifier();

        $favoriteGif = FavoriteGif::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return response($favoriteGif, $favoriteGif ? 200 : 404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favoriteGif = new FavoriteGif;
        $favoriteGif->gif_id = $request->get('gif_id');
        $favoriteGif->keyword = $request->get('keyword');
        $favoriteGif->user_id = auth()->user()->getAuthIdentifier();
        $favoriteGif->save();

        return response($favoriteGif, 201);
    }

    /**
     * @param integer $gifId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($gifId)
    {
        $userId = auth()->user()->getAuthIdentifier();

        $favoriteGif = FavoriteGif::where('user_id', $userId)
            ->where('gif_id', $gifId)
            ->firstOrFail();

        $favoriteGif->delete();

        return response(null, 204);
    }
}
