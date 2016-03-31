<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aston\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Aston\BackBundle\Entity\Post;

/**
 * Description of Post
 *
 * @author yoann
 */
class PostController extends Controller
{

  public function listAction()
  {
    $m = $this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Post');
    
    $posts = $repo->findAll();
    
    return $this->render('AstonBackBundle:Post:list.html.twig', [
        'posts' => $posts
    ]);
  }
  
  public function detailAction(Request $req)
  {
    $m =$this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Post');
    
    if(!($post = $repo->find($req->get('id')))){
      throw $this->createNotFoundException('Post not found');
    }
    
    return $this->render('AstonBackBundle:Post:detail.html.twig', [
        'post' => $post
    ]);
  }

  public function addAction(Request $req)
  {
    $form = $this->createForm('Aston\BackBundle\Form\Type\PostType', new Post());
    $form->handleRequest($req);
    
    if($form->isSubmitted() && $form->isValid()){
      $m = $this->getDoctrine()->getManager();
      $m->persist($form->getData());
      $m->flush();
      
      return $this->redirect( $this->generateUrl('aston_back_blog_list', []) );
    }
    
    return $this->render('AstonBackBundle:Post:form.html.twig', [
        'form' => $form->createView(),
    ]);
  }
  
  public function updateAction(Request $req)
  {
    $m =$this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Post');
    
    if(!($post = $repo->find($req->get('id')))){
      throw $this->createNotFoundException('Post not found');
    }
    
    $form = $this->createForm('Aston\BackBundle\Form\Type\PostType', $post);
    $form->handleRequest($req);
        
    if($req->isMethod('POST') && $form->isValid()){
      $m->flush();
            
      //ajout de l'autocomplession liée à session
      /*@var $session \Symfony\Component\HttpFoundation\Session\Session*/
      //$session = $this->get('session');
      //$session->getFlashBag()->add('success', 'Bravo, ton post ' . $req->get('title') . ' a été modifié avec succés!');
      
      $this->addFlash('success', 'Post "' . $form['title']->getData() . '" modifié avec succés!');
      
      return $this->redirect( $this->generateUrl('aston_back_blog_list', []) );
    }
    
    return $this->render('AstonBackBundle:Post:form.html.twig', [
        'form' => $form->createView(),
    ]);
  }

  public function deleteAction(Request $req)
  {
    $m =$this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Post');
    
    if(!($post = $repo->find($req->get('id')))){
      throw $this->createNotFoundException('Post not found');
    }
    
    $m->remove($post);
    $m->flush();
    
    return $this->redirect( $this->generateUrl('aston_back_blog_list', []) );
  }
    
}
