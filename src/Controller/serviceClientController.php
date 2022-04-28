<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class serviceClientController extends AbstractController
{
    #[Route('/serviceclient', name: 'serviceclient', methods: ['GET', 'POST'])]
    public function serviceclient ()
    {
        return $this->render('pages/serviceclient.html.twig');
    }
}