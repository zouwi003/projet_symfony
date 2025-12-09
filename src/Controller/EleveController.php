<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/eleves')]
class EleveController extends AbstractController
{
    #[Route('/', name: 'app_eleve_index', methods: ['GET'])]
    public function index(EleveRepository $eleveRepository): Response
    {
        return $this->render('eleve/index.html.twig', [
            'eleves' => $eleveRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_eleve_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eleve = new Eleve();
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eleve);
            $entityManager->flush();

            return $this->redirectToRoute('app_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('eleve/new.html.twig', [
            'eleve' => $eleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eleve_show', methods: ['GET'])]
    public function show(Eleve $eleve): Response
    {
        return $this->render('eleve/show.html.twig', [
            'eleve' => $eleve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eleve_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Eleve $eleve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_eleve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('eleve/edit.html.twig', [
            'eleve' => $eleve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_eleve_delete', methods: ['POST'])]
    public function delete(Request $request, Eleve $eleve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eleve->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($eleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eleve_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/notes', name: 'app_eleve_notes', methods: ['GET'])]
    public function notes(Eleve $eleve): Response
    {
        return $this->render('eleve/notes.html.twig', [
            'eleve' => $eleve,
            'notes' => $eleve->getNotes(),
        ]);
    }

    #[Route('/{id}/bulletin', name: 'app_eleve_bulletin', methods: ['GET'])]
    public function bulletin(Eleve $eleve, NoteRepository $noteRepository): Response
    {
        // Calculer les moyennes par matière
        $moyennesParMatiere = $noteRepository->findMoyennesParMatiere($eleve->getId());
        
        // Calculer la moyenne générale
        $moyenneGenerale = $noteRepository->findMoyenneGenerale($eleve->getId());

        return $this->render('eleve/bulletin.html.twig', [
            'eleve' => $eleve,
            'notes' => $eleve->getNotes(),
            'moyennesParMatiere' => $moyennesParMatiere,
            'moyenneGenerale' => $moyenneGenerale,
        ]);
    }
}

