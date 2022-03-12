<?php

namespace App\Form;

use App\Entity\Grade;
use App\Entity\Student;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('student_id', TextType::class, [
                'label' => 'Student ID',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('student_name', TextType::class, [
                'label' => 'Student Name',
                'required' => true,
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 5
                ]
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Student Genre',
                'required' => true,
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female'
                ]
            ])
            ->add('student_dob', DateType::class, [
                'label' => 'Student Date of Birth',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 2
                ]
            ])
            ->add('student_email',TextType::class, [
                'label' => 'Student Email',
                'required' => true,
                'attr' => [
                    'maxlength' => 100,
                    'minlength' => 5
                ]
            ])
            ->add('student_address',TextType::class, [
                'label' => 'Student Address',
                'required' => true,
                'attr' => [
                    'maxlength' => 100,
                    'minlength' => 5
                ]
            ])
            ->add('student_image',FileType::class, [
                'label' => 'Student Image',
                'data_class' => null,
                'required' => is_null ($builder->getData()->getStudentImage())
            ])
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'class_name',
                'multiple' => false,
                'expanded' => false
            ])
           ->add('Submit', SubmitType::class)
        ;    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
