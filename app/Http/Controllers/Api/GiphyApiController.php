<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GiphyApiHandler;
use Illuminate\Http\Request;

class GiphyApiController extends Controller
{
    /**
     * @var GiphyApiHandler
     */
    private $giphyApi;

    /**
     * GiphyApiController constructor.
     * @param GiphyApiHandler $giphyApiHandler
     */
    public function __construct(GiphyApiHandler $giphyApiHandler)
    {
        $this->giphyApi = $giphyApiHandler;
    }

    public function search($query)
    {
        $result = $this->giphyApi->search($query, []);
        $response = ['success' => true, 'result' => json_decode($result)];

        return response($response, 200);
    }
}
