<?php

namespace App\Service;

use DateTime;

class Generator
{
    public function getUrlsForClass(DateTime $date): array
    {
        $urls = [];

        foreach (explode(',', getenv('SUBSTITUTIONS_DATE_SCHEMAS')) as $key => $value) {
            $urls[] = sprintf(
                '%1$s/plan/zastepstwa/%2$s/plany/%3$s.html',
                rtrim(getenv('TIMETABLE_HOST'), '/'),
                $date->format($value),
                getenv('TIMETABLE_SYMBOL')
            );
        }

        return $urls;
    }

    public function getUrlsForIndex(DateTime $date): array
    {
        $urls = [];

        foreach (explode(',', getenv('SUBSTITUTIONS_DATE_SCHEMAS')) as $key => $value) {
            $urls[] = sprintf(
                '%1$s/plan/zastepstwa/%2$s',
                rtrim(getenv('TIMETABLE_HOST'), '/'),
                $date->format($value)
            );
        }

        return $urls;
    }
}
