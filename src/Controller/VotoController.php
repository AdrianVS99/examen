<?php

namespace App\Controller;

use App\Entity\Voto;
use App\Form\VotoType;
use App\Repository\VotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/voto')]
class VotoController extends AbstractController
{
    #[Route('/', name: 'app_voto_index', methods: ['GET'])]
    public function index(VotoRepository $votoRepository): Response
    {
        return $this->render('voto/index.html.twig', [
            'votos' => $votoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_voto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voto = new Voto();
        $form = $this->createForm(VotoType::class, $voto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voto);
            $entityManager->flush();

            return $this->redirectToRoute('app_voto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voto/new.html.twig', [
            'voto' => $voto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voto_show', methods: ['GET'])]
    public function show(Voto $voto): Response
    {
        return $this->render('voto/show.html.twig', [
            'voto' => $voto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voto $voto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VotoType::class, $voto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voto/edit.html.twig', [
            'voto' => $voto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voto_delete', methods: ['POST'])]
    public function delete(Request $request, Voto $voto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voto_index', [], Response::HTTP_SEE_OTHER);
    }
}
