<?php

namespace App\Form;

use App\Entity\Subject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject_id',TextType::class, [
                'label' => 'Subject ID',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('subject_name',TextType::class, [
                'label' => 'Subject Name',
                'required' => true,
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 5
                ]
            ])
            ->add('subject_teacher',TextType::class, [
                'label' => 'Subject Teacher',
                'required' => true,
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 5
                ]
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subject::class,
        ]);
    }
}
