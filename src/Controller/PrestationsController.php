<?php

namespace App\Controller;

use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PrestationsController extends AbstractController
{
    #[Route('/prestations', name: 'prestations', methods: ['GET', 'POST'])]
    public function prestations(PrestationRepository $prestationRepository)
    {
        $prestations = $prestationRepository->findAll();

        return $this->render('/pages/prestations.html.twig', [
            'prestations' => $prestations
        ]);
    }

    #[Route('/prestation/{title}', name: 'prestation', methods: ['GET', 'POST'])]
    public function prestation(PrestationRepository $prestationRepository, $title)
    {
        $presta = $prestationRepository->findOneBy(['title' => $title]);

        return $this->render('pages/prestation.html.twig', [
            'presta' => $presta
        ]);
    }
}
