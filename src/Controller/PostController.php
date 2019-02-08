<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class PostController extends Controller
{

    private $security;

    /**
     * PostController constructor.
     * @param $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    /**
     * @Route("/post/create", name="createPost")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function createPostAction(Request $request, AuthenticationUtils $authenticationUtils, ValidatorInterface $validator)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //validate the data user entered
            $errors = $validator->validate($post);

            if ( count($errors) > 0 ){
                dump($errors);
                return $this->render('post/form.html.twig', [
                    'form' => $form->createView(),
                    'errors' => $errors
                ]);
            }

            //associate the post to the connected user
            $post->setUser($this->security->getUser());

            //persist the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('viewPost',['id' => $post->getId()]);

        }

        return $this->render('post/form.html.twig', [
            'form' => $form->createView(),
            'errors' => null
        ]);
    }

    /**
     * @Route("/post/view/{id}",name="viewPost")
     */
    public function viewPostAction($id)
    {

        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        if ($post) {
            return $this->render('post_details.html.twig', array(
                'post' => $post));
        } else {
            return new Response('no such post');//TODO return error
        }
    }

    /**
     * @Route("/posts",name="viewPosts")
     * @param Request $request
     * @return Response
     */
    public function viewPostsAction(Request $request)
    {

        $allPostsQuery = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();

        $paginator  = $this->get('knp_paginator');

        $posts = $paginator->paginate($allPostsQuery, $request->query->getInt('page', 1),3);

        return $this->render('view_posts.html.twig', array(
            'posts' => $posts));

    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @Route("/post/update/{id}",name="updatePost")
     */
    public function updatePostAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository(Post::class)->find($id);
        dump($post);

        if (!$post) {
            return new Response('no such post');
        }//Todo return error

        if ($post->getUser()->getId() !== $this->security->getUser()->getId()) {
            return new Response('you are not authorized to edit this post');//TODO expetion not authorized
        }

        $form = $this->createForm(PostType::class, $post);
        $form->setData($post);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $post = $form->getData();
            dump($post);//todo to delete
            $em->flush();
            return new Response('post updated');
        }

        return $this->render('post/form.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/post/delete/{id}",name="deletePost")
     */
    public function deletePostAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository(Post::class)->find($id);

        if (!$post){
            return new Response('no such post');
        }//Todo return error

        if ($post->getUser()->getId() !== $this->security->getUser()->getId()) {
            return new Response('you are not authorized to delete this post');//TODO expetion not authorized
        }

        $em->remove($post);
        $em->flush();

        return new Response('post removed');

    }
}
