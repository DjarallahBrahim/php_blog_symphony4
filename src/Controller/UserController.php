<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 11/02/19
 * Time: 09:47
 */

namespace App\Controller;


use App\Entity\User;
use App\Entity\Post;
use App\Form\UserDataType;
use App\Form\UserPasswordUpdateType;
use App\Form\UserType;
use App\payload\PasswordUpdate;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;





use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    private $security;

    /**
     * UserController constructor.
     * @param $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    /**
     * @Route("/register",name="Register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param ValidatorInterface $validator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator ){

        $user = new User();


        $form = $this->createForm(UserType::class,$user);

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

    /**
     * @Route("/user/update",name="UserUpdate")
     */
    public function updateUserAction(Request $request, ValidatorInterface $validator ,UserPasswordEncoderInterface $encoder)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)
            ->find($this->security->getUser()->getId());

        $passwrd = $user->getPassword();

        $form = $this->createForm(UserDataType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            //password :: just to pass the validation because  I didn't add it in that form it has his own form
            $user->setPassword('admin1234');

            $errors = $validator->validate($user);

            $user->setPassword($passwrd);

            if ( count($errors) > 0 ){
                return $this->render('user_update.html.twig', [
                    'form' => $form->createView(),
                    'errors' => $errors
                ]);
            }

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('userProfile');

        }

        return $this->render('user_update.html.twig', [
            'form' => $form->createView(),
            'errors' => null
        ]);
    }


    /**
     * @Route("/user/update/password",name="UserUpdatePassword")
     */
    public function updateUserPasswordAction(Request $request, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder )
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)
            ->find($this->security->getUser()->getId());

        $passwordUpdate = new PasswordUpdate();

        $form = $this->createForm(UserPasswordUpdateType::class,$passwordUpdate);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = $validator->validate($passwordUpdate);

            if ( count($errors) > 0 ){
                return $this->render('user_password_update.html.twig', [
                    'form' => $form->createView(),
                    'errors' => $errors
                ]);
            }

            //set the new password
            $user->setPassword(
                $encoder->encodePassword($user,$passwordUpdate->getNewPassword())
            );

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('viewPosts');

        }

        return $this->render('user_password_update.html.twig', [
            'form' => $form->createView(),
            'errors' => null
        ]);
    }

    /**
     * @Route("/user/profile", name="userProfile")
     */
    function userProfileAction(Request $request, PaginatorInterface $paginator){
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)
            ->find($this->security->getUser()->getId());

        $userPosts = $em->getRepository(Post::class)
                    ->findByUser($user->getId());

        $posts = $paginator->paginate($userPosts, $request->query->getInt('page', 1),3);


        return $this->render('user_profil.html.twig',[
            'posts' => $posts,
            'user' => $user
        ]);
    }

}