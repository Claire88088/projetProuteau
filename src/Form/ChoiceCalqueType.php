<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceCalqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calque', ChoiceType::class,[
                'choices' => [
                    'Travaux' => 'travaux',
                    'Shipping' => 'valeur',
                    'Priority Shipping' => 'priority',
                ]
            ]);
    }
}
