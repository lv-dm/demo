<?php

namespace App\Form;

use App\Entity\Income;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class IncomeRepeatingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Amount', NumberType::class)
            ->add('income_date', DateTimeType::class, [
                'input'  => 'datetime', 
                'widget' => 'single_text',
                'input_format' => 'yyyy-MM-dd H:i:s'
            ],
            [
                'attr' => [
                    'class' => 'row g-3 col-3'
                ]
            ])

            ->add('repeating', IntegerType::class,
            [
                'required' => true,
                'error_bubbling' => true,
                'attr' => [
                  'min' => 0
                ]
            ])

            ->add('Submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Income::class,
        ]);
    }
}
