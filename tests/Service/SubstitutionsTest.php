<?php

namespace App\Tests\Service;

use App\Service\Checker;
use App\Service\Substitutions;
use App\Service\SubstitutionUrlsGenerator;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class SubstitutionsTest extends TestCase
{
    public function testGetInfoForNull(): void
    {
        $generator = $this->getMockBuilder(SubstitutionUrlsGenerator::class)->getMock();
        $checker = $this->getMockBuilder(Checker::class)->getMock();
        $checker->method('getWorkingResponse')->willReturn(null);

        $substitutions = new Substitutions($generator, $checker);
        $info = $substitutions->getInfoFor('10 January 2018');

        $this->assertEquals('2018-01-10', $info['date']);
    }

    public function testGetInfoFor(): void
    {
        $generator = $this->getMockBuilder(SubstitutionUrlsGenerator::class)->getMock();

        $response = $this->getMockBuilder(Response::class)->getMock();
        $response->method('getHeaderLine')->willReturn('Sun, 04 Mar 2018 02:58:51 GMT');

        $checker = $this->getMockBuilder(Checker::class)->getMock();
        $checker->method('getWorkingResponse')->willReturn([
            'http://example.test/plany/o19.html',
            $response
        ]);

        $substitutions = new Substitutions($generator, $checker);
        $info = $substitutions->getInfoFor('10 January 2018');

        $this->assertEquals('http://example.test/plany/o19.html', $info['url']);
        $this->assertEquals('2018-01-10', $info['date']);
        $this->assertEquals('2018-03-04 03:58:51', $info['added']);
    }
}
