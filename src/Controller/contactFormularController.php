<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use App\Form\ContactFormularType;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class contactFormularController extends AbstractController
{
    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function contact(ContactRepository $contactRepository)
    {
        return $this->render('contactFormular.html.twig');
    }

    #[Route('/demandeContact', name: 'demandeContact', methods: ['GET', 'POST'])]
    public function addContact(ContactRepository $contactRepository, UserRepository $userRepository, Request $request)
    {
        $contactRequest = new Contact();
        $dateNow = new \DateTime('now');
        $formContactRequest = $this->createForm(ContactFormularType::class, $contactRequest);
        $formContactRequest ->handleRequest($request);
        if ($formContactRequest->isSubmitted() && $formContactRequest->isValid()) {
            $contactRepository  //->setRequestDate($dateNow) VOIR SI JE METS UN CHAMP "date request" DANS MA TABLE  ContactFormularType.
                                    ->add($contactRequest);
            return $this->render('pages/resumeContact.html.twig', [
                    'request' => $request
                ]);
        }
        return $this->render('formular/contactFormular.html.twig', [
                'formContactRequest' => $formContactRequest->createView()
            ]);
    }
    #[Route('/demandeContact/resumeContact', name: 'resumeContact', methods: ['GET', 'POST'])]
    public function resumeContact(ContactRepository $contactRepository, UserRepository $userRepository, Request $request)
    {
        return $this->render('pages/resumeContact.html.twig', [
            'request' => $request
        ]);
    }
}
