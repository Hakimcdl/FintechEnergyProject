<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class profilesAdminController extends AbstractController
{
    #[Route('/profiles', name: 'view_Profiles', methods: ['GET', 'POST'])]
    public function viewProfiles(UserRepository $userRepository)
    {

        // recupere tout les utilisateurs de la table UserRepository
        $users = $userRepository->findAll();
        return $this->render('profilesAdminHandler.html.twig', [
            'users' => $users
        ]);
    }


    #[Route('/profiles/remove/{id}', name: 'remove_user', methods: ['GET', 'POST'])]
    public function removeUser(UserRepository $userRepository, $id)
    {

        // $this va chercher la fonction get user par son id et va recuperer le roles de l'admin
        if ($this->getUser()->getId() == $id || $this->getUser()->getRoles() === ['ROLE_ADMIN']) {
            // recupère les id de tout les membres grace a la table user
            $userRemove = $userRepository->findOneBy(['id' => $id]);

            $remove = $userRepository->remove($userRemove);
            if ($remove == true) {

                return $this->redirectToRoute('view_Profiles');
            }
            return $this->redirectToRoute('view_Profiles');
        }
    }


}