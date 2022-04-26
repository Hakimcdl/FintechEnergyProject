<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Prestation;
use App\Form\PartAppointmentType;
use App\Form\ProAppointmentType;
use App\Repository\AppointmentRepository;
use App\Repository\PrestationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class choicePartProfController extends AbstractController
{
    #[Route('/{titlePresta}/statut', name: 'choicePartProf', methods: ['GET', 'POST'])]
    public function choice(PrestationRepository $prestationRepository, $titlePresta)
    {

        return $this->render('pages/choicePartProf.html.twig',[
            'titlePresta' => $titlePresta
        ]);
    }

    #[Route('/{titlePresta}/{FormulaireStatus}/formulaire', name: 'addFormular', methods: ['GET', 'POST'])]
    public function addFormular (AppointmentRepository $appointmentRepository, Request $request, $titlePresta, $FormulaireStatus, EntityManagerInterface $entityManager)
    {
        $appointment = new Appointment();
        $dateNow = new \DateTime('now');

        if ($FormulaireStatus === 'particulier' ){
            $formType = PartAppointmentType::class;
        }else{
            $formType = ProAppointmentType::class;
        }

        $formAppointment = $this->createForm($formType, $appointment);

        $formAppointment->handleRequest($request);
        if ($formAppointment->isSubmitted() && $formAppointment->isValid()) {
            $appointment->setRequestDate($dateNow)
                        ->setActive(true);
            $appointmentRepository->add($appointment);

            $prestas = $appointment->getPrestationaccessupdate();
            foreach ($prestas as $presta){;
                $appointment->addPrestationaccessupdate($presta);
            }
            $appointmentRepository->add($appointment);
            //dd($prestas, $appointmentRepository->findOneBy(['id'=>$appointment->getId()]));
            return $this->render('pages/resume.html.twig', [
                'formAppointment' => $formAppointment->createView(),
                'status' => $FormulaireStatus
            ]);
        }
        return $this->render('formular/formularAppointment.html.twig', [
            'formAppointment' => $formAppointment->createView(),
            'status' => $FormulaireStatus
        ]);
    }

    #[Route('{titlePresta}/{FormulaireStatus}/formulaire/resume', name: 'resume', methods: ['GET', 'POST'])]
    public function resumePrestation (AppointmentRepository $appointmentRepository, $titlePresta)
    {
        return $this->render('pages/resume.html.twig',[
            'titlePresta' => $titlePresta
        ]);
    }
}