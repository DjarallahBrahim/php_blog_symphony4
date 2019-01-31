<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();

        $lastUserName = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error'=> $error,
            'lastUserName' =>$lastUserName
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

    }

    /**
     * @Route("/account/create",name="AccountCreate")
     */
    public function acountCreateAction(Request $request,UserPasswordEncoderInterface $encoder){

        $user = new User();

        $form = $this->createForm(AccountType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();

            //encode the password
            $user->setPassword(
                $encoder->encodePassword($user,$user->getPassword())
            );

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('signup.html.twig', array(
            'form' => $form->createView()));
    }


}
