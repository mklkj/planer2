<?php

namespace App\Service;

use DateTime;

class Generator
{
    public function getTimetableUrl(string $date, string $timetable = null) : string
    {
        $url = sprintf(
            '%1$s/plan/zastepstwa/%2$s/plany/%3$s.html',
            rtrim(getenv('TIMETABLE_HOST'), '/'),
            $date,
            $timetable
        );

        if (null === $timetable) {
            $url = sprintf(
                '%1$s/plan/zastepstwa/%2$s',
                rtrim(getenv('TIMETABLE_HOST'), '/'),
                $date
            );
        }

        return $url;
    }

    /**
     * Create array of urls from format.
     *
     * @param DateTime $date
     *
     * @return array
     */
    public function getUrlsForClass(DateTime $date): array
    {
        $urls = [];

        foreach (explode(',', getenv('SUBSTITUTIONS_DATE_SCHEMAS')) as $key => $value) {
            $urls[] = $this->getTimetableUrl(
                $date->format($value),
                getenv('TIMETABLE_SYMBOL')
            );
        }

        return $urls;
    }

    /**
     * Create url for substitutions index.html file.
     *
     * @param DateTime $date Substitutions date
     *
     * @return array
     */
    public function getUrlsForIndex(DateTime $date): array
    {
        $urls = [];

        foreach (explode(',', getenv('SUBSTITUTIONS_DATE_SCHEMAS')) as $key => $value) {
            $urls[] = $this->getTimetableUrl(sprintf(
                '%1$s/plan/zastepstwa/%2$s',
                rtrim(getenv('TIMETABLE_HOST'), '/'),
                $date->format($value)
            ));
        }

        return $urls;
    }
}
