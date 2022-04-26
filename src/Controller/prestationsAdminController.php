<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/prestation')]
class prestationsAdminController extends AbstractController
{
    #[Route('/ajouter', name: 'addPresta')]
    public function addPresta(PrestationRepository $prestationRepository, Request $request, UserRepository $userRepository)
    {
        if( $this->getUser()->getRoles() === ['ROLE_ADMIN'] ){
        $prestation = new Prestation();
        $dateNow = new \DateTime('now');
        $formPrestation = $this->createForm(PrestationType::class, $prestation);
        $formPrestation->handleRequest($request);
        if ($formPrestation->isSubmitted() && $formPrestation->isValid()){
            $prestation
                ->setDatecreation($dateNow)
                ->setActive(true);
            $prestationRepository->add($prestation);
            return $this->redirectToRoute('prestations');
        }
        return $this->render('pages/addPresta.html.twig', [
            'formPrestation' => $formPrestation->createView()
        ]);
    }else{
            dd('coucou');
            // return $this->render('security/home.html.twig');
        }

    }

    #[Route('/modifier/{title}', name: 'updatePresta', methods: ['GET', 'POST'])]
    public function updatePresta(PrestationRepository $prestationRepository, $title, Request $request)
    {
        if( $this->getUser()->getRoles() === ['ROLE_ADMIN'] ){
        $updatePrestation =$prestationRepository->findOneBy(['title' => $title]);
        $editFormPresta = $this->createForm(PrestationType::class, $updatePrestation);
        $editFormPresta->handleRequest($request);
        if ($editFormPresta->isSubmitted() && $editFormPresta->isValid()) {
            $prestationRepository->add($updatePrestation);
            return $this->redirectToRoute('prestations');
            }
        }
        return $this->render('pages/updatePresta.html.twig', [
            'editFormPresta' => $editFormPresta->createView()
        ]);
    }

    #[Route('/supprimer/{title}', name: 'removePresta', methods: ['GET', 'POST'])]
    public function removePresta(PrestationRepository $prestationRepository, $title)
    {
        if( $this->getUser()->getRoles() === ['ROLE_ADMIN'] ){
        $deletePresta = $prestationRepository->findOneBy(['title' => $title]);
        $prestationRepository->remove($deletePresta);
        }

        return $this->redirectToRoute('prestations');
    }
}