<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function new(Request $request)
    {
        $post = new Post();

        $post->setCreatedAt(date("Y-m-d H:i:s"));
        $post->setUpdatedAt(date("Y-m-d H:i:s"));
        //$post->setAuthor("");

        $form = $this->createForm(PostType::class,$post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //TODO steal need to persist the data 
            return new Response("hello world");
        }
            return $this->render('post/form.html.twig', array(
            'form' => $form->createView()));
    }


}
