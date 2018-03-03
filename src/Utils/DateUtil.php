<?php

namespace App\Utils;

use DateTime;
use DateTimeZone;

class DateUtil
{
    /**
     * Normalize server date time.
     *
     * @param string $date Date format D, d M Y H:i:s GMT
     *
     * @return DateTime
     */
    public static function normalize(string $date): DateTime
    {
        $datetime = DateTime::createFromFormat(
            'D, d M Y H:i:s \G\M\T',
            $date,
            new DateTimeZone('GMT')
        );

        if (false === $datetime) {
            return new DateTime('1970-01-01 00:00');
        }

        // change the timezone of the object without changing it's time
        $datetime->setTimezone(new DateTimeZone('Europe/Warsaw'));

        return $datetime;
    }
}
