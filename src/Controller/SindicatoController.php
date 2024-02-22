<?php

namespace App\Controller;

use App\Entity\Sindicato;
use App\Form\SindicatoType;
use App\Repository\SindicatoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sindicato')]
class SindicatoController extends AbstractController
{
    #[Route('/', name: 'app_sindicato_index', methods: ['GET'])]
    public function index(SindicatoRepository $sindicatoRepository): Response
    {
        return $this->render('sindicato/index.html.twig', [
            'sindicatos' => $sindicatoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sindicato_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sindicato = new Sindicato();
        $form = $this->createForm(SindicatoType::class, $sindicato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sindicato);
            $entityManager->flush();

            return $this->redirectToRoute('app_sindicato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sindicato/new.html.twig', [
            'sindicato' => $sindicato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sindicato_show', methods: ['GET'])]
    public function show(Sindicato $sindicato): Response
    {
        return $this->render('sindicato/show.html.twig', [
            'sindicato' => $sindicato,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sindicato_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sindicato $sindicato, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SindicatoType::class, $sindicato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sindicato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sindicato/edit.html.twig', [
            'sindicato' => $sindicato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sindicato_delete', methods: ['POST'])]
    public function delete(Request $request, Sindicato $sindicato, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sindicato->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sindicato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sindicato_index', [], Response::HTTP_SEE_OTHER);
    }
}
