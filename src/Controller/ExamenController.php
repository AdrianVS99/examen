<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MesaRepository;
use App\Repository\SindicatoRepository;
use App\Form\VotosType;
use App\Entity\Mesa;
use App\Entity\Sindicato;
use App\Entity\Voto;
use App\Form\VotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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

  
    #[Route('/editar/{mesa_id}', name: 'actualizar_votos')]
    public function editarVotos(Request $request, EntityManagerInterface $entityManager, int $mesa_id): Response
    {
        // $entityManager = $this->getDoctrine()->getManager();

        $mesa = $entityManager->getRepository(Mesa::class)->find($mesa_id);

        // Obtener los votos asociados a la mesa
        $votos = $mesa->getVotos();
    
        // Crear el formulario
        $form = $this->createForm(VotosType::class, null, ['votos' => $votos]);
    
        // Manejar el envío del formulario
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Procesar los datos del formulario y guardarlos en la base de datos
            foreach ($votos as $voto) {
                $votoId = $voto->getId();
                $newVotesCount = $form->get($votoId)->getData();
                $voto->setVotos($newVotesCount);
                $entityManager->persist($voto);
            }
            $entityManager->flush();
    
            // Redirigir al usuario a alguna parte, como la página de detalles de la mesa
            return $this->redirectToRoute('elecciones');
        }
    
        // Renderizar la vista Twig con el formulario
        return $this->render('examen/editarvotos.html.twig', [
            'form' => $form->createView(),
            'votos' => $votos,
        ]);
    }
}
