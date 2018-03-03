<?php

namespace App\Service;

use DateTime;

class SubstitutionUrlsGenerator
{
    public function getUrlsForClass(DateTime $date): array
    {
        $urls = [];

        foreach (explode(',', getenv('SUBSTITUTIONS_DATE_SCHEMES')) as $key => $value) {
            $urls[] = sprintf(
                '%1$s/%2$s/plany/%3$s.html',
                rtrim(getenv('SUBSTITUTIONS_BASE_URL'), '/'),
                $date->format($value),
                getenv('TIMETABLE_SYMBOL')
            );
        }

        return $urls;
    }
}
