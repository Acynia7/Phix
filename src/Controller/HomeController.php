<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuizRepository;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/quizzes', name: 'app_quizzes')]
    public function quizzes(QuizRepository $quizRepository): Response
    {
        $quizzes = $quizRepository->findAll();

        return $this->render('home/quizzes.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    #[Route('/show/{id}', name: 'app_show')]
    public function show(int $id, QuizRepository $quizRepository, QuestionRepository $questionRepository): Response
    {
        $quiz = $quizRepository->show($id);

        if (!$quiz) {
            return $this->render('error/404.html.twig');
        }

        $questions = $quiz->getQuestions();

        return $this->render('quiz/show.html.twig', [
            'quiz' => $quiz,
            'questions' => $questions,
        ]);
    }

    #[Route('/play', name: 'app_join')]
    public function play(): Response
    {
        return $this->render('home/play.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
