<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->getAuthIdentifier();

        $history = History::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return response($history, $history ? 200 : 404);
    }

    public function store(Request $request)
    {
        $history = new History();
        $history->search_string = $request->get('search_string');
        $history->user_id = auth()->user()->getAuthIdentifier();
        $history->save();

        return response($history, 201);
    }
}
