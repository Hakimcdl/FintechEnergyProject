<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class agencesController extends AbstractController
{
    #[Route('/agences', name: 'agences', methods: ['GET', 'POST'])]
    public function agences ()
    {
        return $this->render('pages/agences.html.twig');
    }
}