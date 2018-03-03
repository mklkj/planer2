<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class Checker
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     *
     * @return Response|null
     */
    public function check(string $url) : ?Response
    {
        try {
            return $this->client->request('GET', $url);
        } catch (GuzzleException $e) {
            return null;
        }
    }

    /**
     * Check each item from array for http response 200.
     *
     * @param array $urls
     *
     * @return array|null
     */
    public function getWorkingResponse(array $urls) : ?array
    {
        foreach ($urls as $key => $value) {
            if (\is_object($obj = $this->check($value))) {
                return [
                    'url' => $value,
                    'response' => $obj,
                ];
            }
        }

        return null;
    }
}
