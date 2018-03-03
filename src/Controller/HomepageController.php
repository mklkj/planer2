<?php

namespace App\Controller;

use App\Service\SubstitutionDiscovery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function index(SubstitutionDiscovery $substitutions)
    {
        return $this->render('homepage.html.twig', [
            'days' => [
                'dziś' => $substitutions->getInfoFor('today'),
                'jutro' => $substitutions->getInfoFor('tomorrow'),
                'następny poniedziałek' => $substitutions->getInfoFor('next Monday'),
            ]
        ]);
    }
}
