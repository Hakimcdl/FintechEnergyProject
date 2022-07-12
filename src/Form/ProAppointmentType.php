<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Prestation;
use App\Entity\Residency;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class ProAppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prestationaccessupdate', EntityType::class, [
                'class'=>Prestation::class,
                'choice_label'=>'title',
                'expanded' => true,
                'multiple'=>true
            ])
            ->add('residencyaccessupdate', EntityType::class, [
                'class'=>Residency::class,
                'choice_label'=>'name'
            ])
            ->add('companyName')
            ->add('siret')
            ->add('firstname')
            ->add('lastname')
            ->add('postalAdress')
            ->add('postalCode')
            ->add('surface')
            ->add('mail')
            ->add('phone')
            ->add('callBackRequest', DateType::class, [
                'widget'=>'single_text',
                'format'=>'dd/MM/yyyy',
                'html5'=>false,
                'attr'=>['autocomplete'=>'off', 'value'=>(new \DateTime())->format('d/m/Y')]
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
