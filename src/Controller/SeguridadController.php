<?php
// Generacion de usuarios
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\User;



class SeguridadController extends AbstractController
{
   /* private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
  
    #[Route('/create', name: 'seguridad_create')]
    public function create()
    {
        
        
        $user = new User();
        
        $user->setEmail( "usuario@gmail.com" );
        

        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
            'password'
        ));
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $entityManager->flush();
        
        return new Response( "Usuario Creado" );
    }
*/
    #[Route('/public/test_public', name: 'test_public')]
    public function test_public()
    {
        return new Response( "Parte Publica" );
    }

    #[Route('/private/test_private', name: 'test_private')]
    public function test_private()
    {
        return new Response( "Parte Private" );
    }
}
