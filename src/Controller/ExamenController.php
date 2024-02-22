<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MesaRepository;
use App\Entity\Voto;
use App\Form\VotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class ExamenController extends AbstractController
{
    #[Route('/elecciones', name: 'elecciones')]
    #[Route('/', name: 'app_mesa_index', methods: ['GET'])]
    // #[Security('is_granted("ROLE_USER")')]
    // #[IsGranted("ROLE_USER")]
    

    public function index(MesaRepository $mesaRepository): Response
    {
        return $this->render('examen/index.html.twig', [
            'mesas' => $mesaRepository->findAll(),
        ]);
    }

    #[Route('/votar/{id}', name: 'app_voto_edit', methods: ['GET', 'POST'])]
    public function editarVoto(Request $request, Voto $voto, EntityManagerInterface $entityManager): Response
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
}
