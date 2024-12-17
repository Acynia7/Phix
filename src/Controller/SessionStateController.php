<?php

namespace App\Controller;

use App\Entity\SessionState;
use App\Form\SessionStateType;
use App\Repository\SessionStateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/session/state')]
final class SessionStateController extends AbstractController
{
    #[Route(name: 'app_session_state_index', methods: ['GET'])]
    public function index(SessionStateRepository $sessionStateRepository): Response
    {
        return $this->render('session_state/index.html.twig', [
            'session_states' => $sessionStateRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_session_state_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sessionState = new SessionState();
        $form = $this->createForm(SessionStateType::class, $sessionState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sessionState);
            $entityManager->flush();

            return $this->redirectToRoute('app_session_state_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('session_state/new.html.twig', [
            'session_state' => $sessionState,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_session_state_show', methods: ['GET'])]
    public function show(SessionState $sessionState): Response
    {
        return $this->render('session_state/show.html.twig', [
            'session_state' => $sessionState,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_session_state_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SessionState $sessionState, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SessionStateType::class, $sessionState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_session_state_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('session_state/edit.html.twig', [
            'session_state' => $sessionState,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_session_state_delete', methods: ['POST'])]
    public function delete(Request $request, SessionState $sessionState, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sessionState->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($sessionState);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_session_state_index', [], Response::HTTP_SEE_OTHER);
    }
}
