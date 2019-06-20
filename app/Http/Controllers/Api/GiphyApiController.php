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

        if ($result) {
            $response = ['success' => true, 'result' => json_decode($result)];
            return response($response, 200);
        } else {
            $response = ['success' => false, 'result' => []];
            return response($response, 404)->setStatusCode(404, 'GIF not found');
        }
    }

    public function getGif($id)
    {
        $result = $this->giphyApi->getByID($id);

        if ($result) {
            $response = ['success' => true, 'result' => json_decode($result)];
            return response($response, 200);
        } else {
            $response = ['success' => false, 'result' => []];
            return response($response, 404)->setStatusCode(404, 'GIF not found');
        }
    }

    public function getGifs($ids)
    {
        $result = $this->giphyApi->getByIDs($ids);

        if ($result) {
            $response = ['success' => true, 'result' => json_decode($result)];
            return response($response, 200);
        } else {
            $response = ['success' => false, 'result' => []];
            return response($response, 404)->setStatusCode(404, 'GIF not found');
        }
    }

    public function getTrendyGifs()
    {
        $result = $this->giphyApi->trending();

        if ($result) {
            $response = ['success' => true, 'result' => json_decode($result)];
            return response($response, 200);
        } else {
            $response = ['success' => false, 'result' => []];
            return response($response, 404)->setStatusCode(404, 'GIF not found');
        }
    }
}
