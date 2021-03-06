<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Prestation;
use App\Entity\Residency;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use function Sodium\add;

class PartAppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prestationaccessupdate', EntityType::class, [
                'class'=>Prestation::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true
            ])
            ->add('residencyaccessupdate', EntityType::class, [
                'class'=>Residency::class,
                'choice_label'=>'name'
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('postalAdress')
            ->add('postalCode')
            ->add('surface')
            ->add('mail',  EmailType::class, [
                'constraints' => [
                    new Email()
                ]
            ])
            ->add('phone', TextType::class, [
                'constraints' => [
                    new Regex('/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/')
                ]
            ])
            ->add('callBackRequest', DateType::class, [
                'widget'=>'single_text',
                'format'=>'dd/MM/yyyy',
                'html5'=>false,
                'attr'=>['autocomplete'=>'off', 'value'=>(new \DateTime())->format('d/m/Y')],
            ])
            ->add('note')
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
