<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\PartAppointmentType;
use App\Form\ProAppointmentType;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChoicePartProfController extends AbstractController
{
    #[Route('/{titlePresta}/statut', name: 'choicePartProf', methods: ['GET', 'POST'])]
    public function choice($titlePresta)
    {
        return $this->render('pages/choicePartProf.html.twig', [
            'titlePresta' => $titlePresta
        ]);
    }

    #[Route('/{titlePresta}/{FormulaireStatus}/formulaire', name: 'addFormular', methods: ['GET', 'POST'])]
    public function addFormular(AppointmentRepository $appointmentRepository, Request $request, $titlePresta, $FormulaireStatus)
    {
        $appointment = new Appointment();
        $dateNow = new \DateTime('now');

        if ($FormulaireStatus === 'particulier') {
            $formType = PartAppointmentType::class;
        } else {
            $formType = ProAppointmentType::class;
        }

        $formAppointment = $this->createForm($formType, $appointment);
        $formAppointment->handleRequest($request);

        if ($formAppointment->isSubmitted() && $formAppointment->isValid()) {
            $appointment->setRequestDate($dateNow)
                        ->setActive(true);
            $appointmentRepository->add($appointment);

            $prestas = $appointment->getPrestationaccessupdate();
            foreach ($prestas as $presta) {
                ;
                $appointment->addPrestationaccessupdate($presta);
            }
            $appointmentRepository->add($appointment);

            return $this->render('pages/resumePrestations.html.twig', [
                'formAppointment' => $formAppointment->createView(),
                'status' => $FormulaireStatus
            ]);
        }
        if ($formType === PartAppointmentType::class) {
            return $this->render('formular/formularAppointmentPart.html.twig', [
                'formAppointment' => $formAppointment->createView(),
                'status' => $FormulaireStatus
            ]);
        } else {
            return $this->render('formular/formularAppointmentPro.html.twig', [
                    'formAppointment' => $formAppointment->createView(),
                    'status' => $FormulaireStatus
            ]);
        }
    }

    #[Route('{titlePresta}/{FormulaireStatus}/formulaire/resume', name: 'resume', methods: ['GET', 'POST'])]
    public function resumePrestation($titlePresta)
    {
        return $this->render('pages/resumePrestations.html.twig', [
            'titlePresta' => $titlePresta
        ]);
    }
}
