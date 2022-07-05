<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class helpRenovationController extends AbstractController
{
    #[Route('/helpRenovation', name: 'helpRenovation', methods: ['GET', 'POST'])]
    public function helpRenovation()
    {
        return $this->render('pages/helpRenovation.twig');
    }
}
