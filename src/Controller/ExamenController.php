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
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\Regex;


class ExamenController extends AbstractController
{
    #[Route('/elecciones', name: 'elecciones')]
    #[Route('/', name: 'app_mesa_index', methods: ['GET'])]

    

    public function index(MesaRepository $mesaRepository, EntityManagerInterface $entityManager,PaginatorInterface $paginator, Request $request): Response
    {
        $query = $entityManager->getRepository(Mesa::class)->createQueryBuilder('m')
            ->orderBy('m.id', 'ASC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1), 
             2
        );

        return $this->render('examen/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

  
    #[Route('/editar/{mesa_id}', name: 'actualizar_votos')]
    public function editarVotos(Request $request, EntityManagerInterface $entityManager,ValidatorInterface $validator, int $mesa_id): Response
    {
    

        $mesa = $entityManager->getRepository(Mesa::class)->find($mesa_id);

     
        $votos = $mesa->getVotos();
    
   
        $form = $this->createForm(VotosType::class, null, ['votos' => $votos]);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
       
            foreach ($votos as $voto) {
                $votoId = $voto->getId();
                $newVotesCount = $form->get($votoId)->getData();

                $voto->setVotos($newVotesCount);
                $entityManager->persist($voto);
            }
            $entityManager->flush();
    
   
            return $this->redirectToRoute('elecciones');
        }
    
    
        return $this->render('examen/editarvotos.html.twig', [
            'form' => $form->createView(),
            'votos' => $votos,
        ]);
    }
}
