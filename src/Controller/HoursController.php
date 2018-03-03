<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HoursController extends Controller
{
    public function index()
    {
        $client = new Client();
        $html = $client->get(getenv('HOURS_URL'))->getBody();

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $table = $dom->getElementsByTagName('table')->item(0);

        return $this->render('hours.html.twig', [
            'table' => $dom->saveHTML($table),
        ]);
    }
}
