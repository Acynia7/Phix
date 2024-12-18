<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\Answer;
use App\Form\QuizFormType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/quiz')]
class QuizController extends AbstractController
{
    #[Route('/{id}', name: 'app_quiz', defaults: ['id' => null])]
    public function QuizFormCollectionType(Request $request, QuizRepository $QuizRepository, ?Quiz $quiz = null, ?Question $question): Response
    {
        if (!$quiz) {
            $quiz = new Quiz();
            $question = new Question();
            $quiz->addQuestion($question);
        }
        $form = $this->createForm(QuizFormType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $QuizRepository->add($form->getData(), true);

            return $this->redirectToRoute('app_quiz');
        }

        return $this->render('quiz/index.html.twig', [
            'form_quiz' => $form,
            'quiz' => $quiz,
        ]);
    }
}