<?php

namespace App\Tests\Service;

use App\Service\Checker;
use App\Service\Timetable;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class TimetableTest extends TestCase
{
    public function testGetInfoResponseNull(): void
    {
        putenv('TIMETABLE_URL=http://example.test/plany/o99.html');

        $checker = $this->getMockBuilder(Checker::class)->getMock();
        $checker->method('check')->willReturn(null);

        $timetable = new Timetable($checker);
        $info = $timetable->getInfo();

        $this->assertEquals('http://example.test/plany/o99.html', $info['url']);
    }

    public function testGetInfo(): void
    {
        putenv('TIMETABLE_URL=http://example.test/plany/o99.html');

        $response = $this->getMockBuilder(Response::class)->getMock();
        $response->method('getHeaderLine')->willReturn('Sun, 04 Mar 2018 03:58:51 GMT');

        $checker = $this->getMockBuilder(Checker::class)->getMock();
        $checker->method('check')->willReturn($response);

        $timetable = new Timetable($checker);
        $info = $timetable->getInfo();

        $this->assertEquals('http://example.test/plany/o99.html', $info['url']);
        $this->assertEquals('2018-03-04 04:58:51', $info['modified']);
    }
}
