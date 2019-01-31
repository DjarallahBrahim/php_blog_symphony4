<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class PostController extends AbstractController
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
     */
    public function createPostAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $post->setUser($this->security->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            //TODO redirect to detail page
            dump($form->getData());//todo to delete
            return new Response('post created successfully');
        }
        return $this->render('post/form.html.twig', array(
            'form' => $form->createView()));
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
     */
    public function viewPostsAction()
    {

        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();

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
