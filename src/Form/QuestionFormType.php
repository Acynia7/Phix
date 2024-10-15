<?php

namespace App\Form;

use App\Entity\Question;
// use App\Entity\Quiz;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('text')
            ->add('chrono')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('active')
            // ->add('quiz', EntityType::class, [
            //     'class' => Quiz::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
