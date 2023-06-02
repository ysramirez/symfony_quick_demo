<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /* este es un hueco de seguridad solo es una demostración*/
    #[Route('/login/promote/{id}', name: 'app_login_promote')]
    public function promoteUserToAdmin(User $user, UserRepository $userRepository ): Response
    {
        $user->addRole('ROLE_ADMIN');

        $userRepository->save($user, true);
        return new Response('Se dio permisos de admin al user '.$user->getEmail());
    }

    /* este es un hueco de seguridad solo es una demostración*/
    #[Route('/login/demote/{id}', name: 'app_login_demote')]
    public function demoteUserToAdmin(User $user, UserRepository $userRepository ): Response
    {
        $user->removeRole('ROLE_ADMIN');

        $userRepository->save($user, true);
        return new Response('Se quitaron permisos de admin al user '.$user->getEmail());
    }
}
