<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class Checker
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function check(string $url) : ?Response
    {
        try {
            return $this->client->request('GET', $url);
        } catch (GuzzleException $e) {
            return null;
        }
    }

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
