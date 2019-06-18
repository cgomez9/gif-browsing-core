<?php

namespace App\Services;

use App\Interfaces\GiphyApiInterface;
use GuzzleHttp\Client as HttpClient;


class GiphyApiHandler implements GiphyApiInterface
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @param $baseUrl
     * @param $apiKey
     */
    public function __construct($baseUrl, $apiKey)
    {
        $this->httpClient = new HttpClient([
            'base_uri' => $baseUrl,
            'query' => ['api_key' => $apiKey]
        ]);
    }

    /**
     * Search GIFs by a keyword or phrase
     *
     * @param $query
     * @param array $params
     *
     * @return string
     */
    public function search($query, array $params = [])
    {
        $params['q'] = $query;
        $params = array_merge(
            $this->httpClient->getConfig('query'),
            $params
        );

        return $this->httpClient->get("gifs/search", ['query' => $params])->getBody()->getContents();
    }

    /**
     * Returns a GIF information by id
     *
     * @param integer $id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->httpClient->get("gifs/$id");
    }

    /**
     * Returns a random GIF,
     *
     * @param array $params
     *
     * @return mixed
     */
    public function random(array $params = [ ])
    {
        return $this->httpClient->get("gifs/random", $params);
    }

}