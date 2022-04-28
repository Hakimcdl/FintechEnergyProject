<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class informationController extends AbstractController
{
    #[Route('/information', name: 'information', methods: ['GET', 'POST'])]
    public function information ()
    {
        return $this->render('pages/information.html.twig');
    }
}