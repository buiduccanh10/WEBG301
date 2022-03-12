<?php

namespace App\Form;

use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('class_id', TextType::class, [
                'label' => 'Class ID',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('class_name', TextType::class, [
                'label' => 'Class Name',
                'required' => true,
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 5
                ]
            ])
            ->add('class_status', ChoiceType::class, [
                'label' => 'Class Status',
                'required' => true,
                'choices' => [
                    'Active' => 'Active',
                    'Inactive' => 'Inactive',
                ],
                'expanded' => true,
            ])
            ->add('Submit', SubmitType::class)           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}
