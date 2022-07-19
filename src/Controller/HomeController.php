<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Repository\PrestationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    #[Route('/profil/remove/{id}', name: 'remove_user_id',methods: ['GET', 'POST'])]
    public function removeUserId(UserRepository $userRepository, int $id, Request $request, TokenStorageInterface $tokenStorage)
    {
        // $this va chercher la fonction get user par son id ou va récupérer le roles de l'admin
        $connectedUserId = $this->getUser() ? $this->getUser()->getId() : null;
        // Cela récupère les id de touts les membres grâce à la table user
        $userRemove = $userRepository->findOneBy(['id' => $id]);

        if ($connectedUserId === $id) {
            // token storage c'est à l'intérieur de ceci que les infos de l'utilisateur sont stockés
            //dd($tokenStorage->getToken()); si on mets pas NULL il va aller chercher les données de l'utilisateur dans la BDD alors que nous il existe plus
            // alors qu'on veut le supprimer d'où ligne 65 et 66 on force la déconnexion avec set token NULL et on le déconnecte avec invalidate (soit le supprimer)
            $tokenStorage->setToken(null);
            $request->getSession()->invalidate();
        }// puis ligne soit 68 on fait l'action de supprimer dans la BDD
            $userRepository->remove($userRemove);
        return $this->redirectToRoute('app_login');
    }
}
