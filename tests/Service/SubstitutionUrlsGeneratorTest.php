<?php

namespace App\Tests\Service;

use App\Service\SubstitutionUrlsGenerator;
use PHPUnit\Framework\TestCase;

class SubstitutionUrlsGeneratorTest extends TestCase
{
    public function testGetUrlsForClassOneScheme(): void
    {
        putenv('SUBSTITUTIONS_DATE_SCHEMES=d-m');
        putenv('SUBSTITUTIONS_BASE_URL=http://example.test/timetable');
        putenv('TIMETABLE_SYMBOL=o99');

        $generator = new SubstitutionUrlsGenerator();
        $urls = $generator->getUrlsForClass(new \DateTime('2018-01-21'));

        $this->assertCount(1, $urls);

        $this->assertEquals('http://example.test/timetable/21-01/plany/o99.html', $urls[0]);
    }

    public function testGetUrlsForClassMultiSchemes(): void
    {
        putenv('SUBSTITUTIONS_DATE_SCHEMES=d-m,m-d,Y-m-d');
        putenv('SUBSTITUTIONS_BASE_URL=http://example.test/timetable');
        putenv('TIMETABLE_SYMBOL=o99');

        $generator = new SubstitutionUrlsGenerator();
        $urls = $generator->getUrlsForClass(new \DateTime('2018-01-21'));

        $this->assertCount(3, $urls);

        $this->assertEquals('http://example.test/timetable/21-01/plany/o99.html', $urls[0]);
        $this->assertEquals('http://example.test/timetable/01-21/plany/o99.html', $urls[1]);
        $this->assertEquals('http://example.test/timetable/2018-01-21/plany/o99.html', $urls[2]);
    }
}
