<?php

namespace App\Tests\Utils;

use App\Utils\DateUtil;
use PHPUnit\Framework\TestCase;

class DateUtilTest extends TestCase
{
    public function testNormalize(): void
    {
        $normalized = DateUtil::normalize('Sun, 04 Mar 2018 02:58:51 GMT');

        $this->assertEquals(
            'Sun, 04 Mar 2018 03:58:51 GMT',
            $normalized->format('D, d M Y H:i:s \G\M\T'));
    }

    public function testNormalizeFalse(): void
    {
        $normalized = DateUtil::normalize('wrong date');

        $this->assertEquals(
            'Thu, 01 Jan 1970 00:00:00 GMT',
            $normalized->format('D, d M Y H:i:s \G\M\T'));
    }
}
