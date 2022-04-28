<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Repository\PrestationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function home(PrestationRepository $prestationRepository)
    {
        $prestations = $prestationRepository->findBy(array(), null, 6);

        return $this->render('home.html.twig', [
            'prestations' => $prestations
        ]);
    }

    #[Route('/profil', name: 'view_profil', methods: ['GET', 'POST'])]
    public function voirProfil(UserRepository $userRepository)
    {
      $idUser = $this->getUser()->getId();
      $user = $userRepository->findOneBy(['id'=>$idUser]);

      return $this->render('viewOneProfil.html.twig' , [
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
            return $this->render('pages/updateOneProfile.html.twig',[
                    'editFormUser' => $editFormUser->createview()
                ]);
    }

    #[Route('/profil/remove/{id}', name: 'remove_user_id' )]
    public function removeUserId(UserRepository $userRepository, $id)
    {
        // $this va chercher la fonction get user par son id ou va recuperer le roles de l'admin
        if ($this->getUser()->getId() == $id ) {
            // recupère les id de tout les membres grace a la table user
            $userRemove = $userRepository->findOneBy(['id' => $id]);

            $remove = $userRepository->remove($userRemove);
            if ($remove == true) {
                return $this->redirectToRoute('home');
            }
        }
                return $this->redirectToRoute('home');
            }
}