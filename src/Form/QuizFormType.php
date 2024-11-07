<?php

namespace App\Form;

use App\Entity\Quiz;
use App\Entity\QuizState;
use App\Entity\User;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class QuizFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('state', EntityType::class, [
                'class' => QuizState::class,
                'choice_label' => 'state',
            ])
            ->add('questions', LiveCollectionType::class, [
                'entry_type' => QuestionFormType::class,
                'entry_options' => ['label' => false],
                'label' => 'Questions',
                'allow_add' => true,
                'button_add_options' => [
                    'label' => 'Add question',
                    'attr' => [
                        'class' => 'btn btn-outline-primary',
                    ],
                ],
                'allow_delete' => true,
                'button_delete_options' => [
                    'label' => 'Delete question',
                    'attr' => [
                        'class' => 'btn btn-outline-danger',
                    ],
                ],
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quiz::class,
        ]);
    }
}
