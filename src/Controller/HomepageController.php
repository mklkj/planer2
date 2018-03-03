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
                'piątek' => $substitutions->getInfoFor('last friday'),
                'dziś' => $substitutions->getInfoFor('today'),
                'jutro' => $substitutions->getInfoFor('tomorrow'),
            ]
        ]);
    }
}
