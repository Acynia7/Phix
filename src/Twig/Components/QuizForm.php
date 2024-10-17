<?php

namespace App\Twig\Components;

use App\Entity\Quiz;
use App\Form\QuizFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent]
class QuizForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?quiz $quiz;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            QuizFormType::class,
            $this->quiz
        );
    }
}