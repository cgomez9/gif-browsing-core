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

    public function getGif($id)
    {
        $result = $this->giphyApi->get($id);

        if ($result) {
            $response = ['success' => true, 'result' => json_decode($result)];
            return response($response, 404)->setStatusCode(404, 'GIF not found');
        } else {
            $response = ['success' => false, 'result' => []];
            return response($response, 200);
        }
    }
}
