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
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
            'error'=> $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

    }

    /**
     * @Route("/account/create",name="AccountCreate")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param ValidatorInterface $validator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function acountCreateAction(Request $request, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator ){

        $user = new User();


        $form = $this->createForm(AccountType::class,$user);

        $form->handleRequest($request);




        if ($form->isSubmitted()){

            $em = $this->getDoctrine()->getManager();

            //validate the data user entered
            $errors = $validator->validate($user);

            //encode the password
            $user->setPassword(
                $encoder->encodePassword($user,$user->getPassword())
            );

            if ( count($errors) > 0 ){
                return $this->render('signup.html.twig', [
                    'form' => $form->createView(),
                    'errors' => $errors
                ]);
            }

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('signup.html.twig', [
            'form' => $form->createView(),
            'errors' => null
        ]);
    }




}
