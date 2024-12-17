<?php

namespace App\Form;

use App\Entity\Question;
// use App\Entity\Quiz;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text')
            ->add('type', ChoiceType::class, [
            'choices' => [
            'Vrai/Faux' => 1,
            'Réponse unique' => 2,
            'QCM' => 3,
            ],
            ])
            ->add('chrono')
            ->add('active')
            ->add('answers', LiveCollectionType::class, [
                'entry_type' => AnswerFormType::class,
                'entry_options' => ['label' => false],
                'label' => 'Answers',
                'allow_add' => true,
                'button_add_options' => [
                    'label' => 'Add answer',
                    'attr' => [
                        'class' => 'btn btn-outline-primary',
                    ],
                ],
                'allow_delete' => true,
                'button_delete_options' => [
                    'label' => 'Delete answer',
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
            'data_class' => Question::class,
        ]);
    }
}
