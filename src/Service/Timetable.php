<?php

namespace App\Service;

use App\Utils\DateUtil;

class Timetable
{
    private $checker;

    public function __construct(Checker $checker)
    {
        $this->checker = $checker;
    }

    public function getInfo(): array
    {
        $url = getenv('TIMETABLE_URL');
        $res = $this->checker->check($url);

        if (null === $res) {
            return [
                'url' => $url,
            ];
        }

        $modified = $res->getHeaderLine('Last-Modified');

        return [
            'url' => $url,
            'modified' => DateUtil::normalize($modified)->format('Y-m-d H:i:s')
        ];
    }
}
