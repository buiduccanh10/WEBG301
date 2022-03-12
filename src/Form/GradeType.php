<?php

namespace App\Form;

use App\Entity\Grade;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GradeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grade_id',IntegerType::class, [
                'label' => 'Grade ID',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('grade_result', FloatType::class, [
                'label' => 'Grade Result',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('student_id',EntityType::class, [
                'class' => Student::class,
                'choice_label' => 'student_id',
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Grade::class,
        ]);
    }
}
