<?php

namespace App\Form;

use App\Entity\Income;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class IncomeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class)
            ->add('income_date', DateTimeType::class, [
                'attr' => [
                    'class' => 'row g-3 col-3'
                ]
            ])

            ->add('Submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ]
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Income::class,
        ]);
    }
}
