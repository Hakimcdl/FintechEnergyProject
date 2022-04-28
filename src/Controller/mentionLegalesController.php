<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class mentionLegalesController extends AbstractController
{
    #[Route('/mentionslegales', name: 'mentionlegales', methods: ['GET', 'POST'])]
    public function mentionlegales ()
    {
        return $this->render('pages/mentionLegales.html.twig');
    }
}