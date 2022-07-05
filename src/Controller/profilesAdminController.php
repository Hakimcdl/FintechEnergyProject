<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfilesAdminController extends AbstractController
{
    #[Route('/profiles', name: 'view_Profiles', methods: ['GET', 'POST'])]
    public function viewProfiles(UserRepository $userRepository)
    {
        // récupère tout les utilisateurs de la table UserRepository
        $users = $userRepository->findAll();
        return $this->render('profilesAdminHandler.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/profiles/update/{id}', name: 'update_user', methods: ['GET', 'POST'])]
    public function updateUser(UserRepository $userRepository, Request $request, $id)
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $updateUser = $userRepository->findOneBy(['id' => $id]);
            $editFormUser = $this->createForm(RegistrationFormType::class, $updateUser);
            $editFormUser ->handleRequest($request);
            if ($editFormUser->isSubmitted() &&  $editFormUser->isValid()) {
                $userRepository->add($updateUser);
                return $this ->redirectToRoute('view_Profiles');
            }
        }
        return $this->render('pages/updateAllProfiles.html.twig', [
            'editFormUser' => $editFormUser->createView()
        ]);
    }

    #[Route('/profiles/remove/{id}', name: 'remove_user', methods: ['GET', 'POST'])]
    public function removeUser(UserRepository $userRepository, $id)
    {
        // $this va chercher la fonction get user par son id et va récupérer le roles de l'admin
        if ($this->isGranted('ROLE_ADMIN')) {
            // Cela récupère les id de touts les membres grace a la table user
            $userRemove = $userRepository->findOneBy(['id' => $id]);

            $remove = $userRepository->remove($userRemove);
            if ($remove == true) {
                return $this->redirectToRoute('view_Profiles');
            }
            return $this->redirectToRoute('view_Profiles');
        }
    }
}
