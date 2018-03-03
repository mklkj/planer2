<?php

namespace App\Service;

use App\Utils\DateUtil;
use GuzzleHttp\Psr7\Response;

class Substitutions
{
    private $generator;

    private $checker;

    public function __construct(SubstitutionUrlsGenerator $generator, Checker $checker)
    {
        $this->generator = $generator;
        $this->checker = $checker;
    }

    public function getInfoFor(string $time): array
    {
        $dateTime = new \DateTime();
        $dateTime->setTimestamp(strtotime($time));

        $urls = $this->generator->getUrlsForClass($dateTime);
        $res = $this->checker->getWorkingResponse($urls);

        if (null === $res) {
            return [
                'date' => $dateTime->format('Y-m-d'),
            ];
        }

        [$url, $response] = array_values($res);

        /** @var Response $response */
        $modified = $response->getHeaderLine('Last-Modified');

        return [
            'url' => $url,
            'date' => $dateTime->format('Y-m-d'),
            'added' => DateUtil::normalize($modified)->format('Y-m-d H:i:s')
        ];
    }
}
