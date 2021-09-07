<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\MigratingPasswordHasher;

class UsersController extends AbstractController
{
//    public function __construct(MigratingPasswordHasher $migratingPasswordHasher)
//    {
//        $this->passwordEncoder = $migratingPasswordHasher;
//    }


    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    public function createUser(Request $request) : Response
    {

        return new Response('toto');
    }
}
