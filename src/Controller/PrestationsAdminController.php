<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/prestation')]
class PrestationsAdminController extends AbstractController
{
    #[Route('/ajouter', name: 'addPresta')]
    public function addPresta(PrestationRepository $prestationRepository, Request $request)
    {
        $prestation = new Prestation();
        $dateNow = new \DateTime('now');
        $formPrestation = $this->createForm(PrestationType::class, $prestation);
        $formPrestation->handleRequest($request);
        if ($formPrestation->isSubmitted() && $formPrestation->isValid()) {
            $prestation
                ->setDatecreation($dateNow)
                ->setActive(true);
            $prestationRepository->add($prestation);
            return $this->redirectToRoute('prestations');
        }
        return $this->render('pages/addPresta.html.twig', [
            'formPrestation' => $formPrestation->createView()
        ]);
    }

    #[Route('/modifier/{title}', name: 'updatePresta', methods: ['GET', 'POST'])]
    public function updatePresta(PrestationRepository $prestationRepository, $title, Request $request)
    {
        $updatePrestation =$prestationRepository->findOneBy(['title' => $title]);
        $editFormPresta = $this->createForm(PrestationType::class, $updatePrestation);
        $editFormPresta->handleRequest($request);
        if ($editFormPresta->isSubmitted() && $editFormPresta->isValid()) {
            $prestationRepository->add($updatePrestation);
            return $this->redirectToRoute('prestations');
        }
        return $this->render('pages/updatePresta.html.twig', [
            'editFormPresta' => $editFormPresta->createView()
        ]);
    }

    #[Route('/supprimer/{title}', name: 'removePresta', methods: ['GET', 'POST'])]
    public function removePresta(PrestationRepository $prestationRepository, $title)
    {
        $deletePresta = $prestationRepository->findOneBy(['title' => $title]);
        $prestationRepository->remove($deletePresta);
        return $this->redirectToRoute('prestations');
    }
}
