<?php

namespace App\Controller;

use App\Service\Substitutions;
use App\Service\Timetable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function index(Substitutions $substitutions, Timetable $timetable)
    {
        return $this->render('homepage.html.twig', [
            'days' => [
                'dziś' => $substitutions->getInfoFor('today'),
                'jutro' => $substitutions->getInfoFor('tomorrow'),
            ],
            'timetable' => $timetable->getInfo(),
            'log_url' => getenv('LOG_URL')
        ]);
    }
}
