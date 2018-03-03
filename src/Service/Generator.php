<?php

namespace App\Service;

use DateTime;

class Generator
{

    /**
     * @var array
     */
    private $config;

    public function __construct()
    {
        $this->config = [
            'host' => 'https://www.zstiojar.edu.pl',
            'timetable' => 'o19',
            'date_schema' => [
//                'j-n',
//                'd-n',
                'j-m',
                'd-m',
            ],
        ];
    }

    public function getTimetableUrl(string $date, string $timetable = null) : string
    {
        if (null === $timetable) {
            return sprintf(
                '%1$s/plan/zastepstwa/%2$s',
                rtrim($this->config['host'], '/'),
                $date
            );
        }

        return sprintf(
            '%1$s/plan/zastepstwa/%2$s/plany/%3$s.html',
            rtrim($this->config['host'], '/'),
            $date,
            $timetable
        );
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

        foreach ((array) $this->config['date_schema'] as $key => $value) {
            $urls[] = $this->getTimetableUrl(
                $date->format($value),
                $this->config['timetable']
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

        foreach ((array) $this->config['date_schema'] as $key => $value) {
            $urls[] = $this->getTimetableUrl($date->format($value));
        }

        return $urls;
    }
}
