<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Repository\PrestationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function home(PrestationRepository $prestationRepository): Response
    {
     $prestations = $prestationRepository->findBy(array(), null);

        return $this->render('home.html.twig', [
          'prestations' => $prestations
        ]);
    }

    #[Route('/profil', name: 'view_profil', methods: ['GET', 'POST'])]
    public function voirProfil(UserRepository $userRepository)
    {
        $idUser = $this->getUser()->getId();
        $user = $userRepository->findOneBy(['id'=>$idUser]);

        return $this->render('viewOneProfil.html.twig', [
          'user' => $user
      ]);
    }

    #[Route('/modifierProfil/{id}', name: 'updateProfil', methods: ['GET', 'POST'])]
    public function updateProfil(UserRepository $userRepository, Request $request, $id)
    {
        $updateUser = $userRepository->findOneBy(['id' => $id]);
        $editFormUser = $this->createForm(RegistrationFormType::class, $updateUser);
        $editFormUser ->handleRequest($request);

        if ($editFormUser->isSubmitted() && $editFormUser->isValid()) {
            $userRepository ->add($updateUser);
            return $this->redirectToRoute('view_profil');
        }
        return $this->render('pages/updateOneProfile.html.twig', [
                    'editFormUser' => $editFormUser->createview()
                ]);
    }

    #[Route('/profil/remove/{id}', name: 'remove_user_id')]
    public function removeUserId(UserRepository $userRepository, $id, Request $request)
    {
        // $this va chercher la fonction get user par son id ou va récupérer le roles de l'admin
        if ($this->getUser()->getId() == $id) {
            // récupère les id de touts les membres grace a la table user
            $userRemove = $userRepository->findOneBy(['id' => $id]);

            $userRepository->remove($userRemove);
            $request->getSession()->invalidate();
            return $this->redirectToRoute('home');
        } else {
            // redirection vers la page d'erreur
            return $this->redirectToRoute('home');
        }
    }
}
