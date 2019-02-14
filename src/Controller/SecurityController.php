<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        //if the user is authenticated redirect
        if ($this->getUser()) {
            return $this->redirectToRoute('viewPosts');
        }

        $error = $authUtils->getLastAuthenticationError();

        $lastUserName = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error'=> $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

    }





}
