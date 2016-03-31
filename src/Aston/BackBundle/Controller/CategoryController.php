<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aston\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Aston\BackBundle\Entity\Category;

/**
 * Description of Post
 *
 * @author yoann
 */
class CategoryController extends Controller
{

  public function listAction()
  {
    $m = $this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Category');
    
    $categories = $repo->findAll();
    
    return $this->render('AstonBackBundle:Category:list.html.twig', [
        'categories' => $categories
    ]);
  }
  
  public function detailAction(Request $req)
  {
    $m =$this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Category');
    
    if(!($category = $repo->find($req->get('id')))){
      throw $this->createNotFoundException('Category not found');
    }
    
    return $this->render('AstonBackBundle:Category:detail.html.twig', [
        'category' => $category
    ]);
  }

  public function addAction(Request $req)
  {
    $form = $this->createForm('Aston\BackBundle\Form\Type\CategoryType', new Category());
    $form->handleRequest($req);
    
    if($form->isSubmitted() && $form->isValid()){
      $m = $this->getDoctrine()->getManager();
      $m->persist($form->getData());
      $m->flush();
      
      return $this->redirect( $this->generateUrl('aston_back_category_list', []) );
    }
    
    return $this->render('AstonBackBundle:Category:form.html.twig', [
        'form' => $form->createView(),
    ]);
  }
  
  public function updateAction(Request $req)
  {
    $m =$this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Category');
    
    if(!($category = $repo->find($req->get('id')))){
      throw $this->createNotFoundException('Category not found');
    }
    
    $form = $this->createForm('Aston\BackBundle\Form\Type\CategoryType', $category);
    $form->handleRequest($req);
        
    if($req->isMethod('POST') && $form->isValid()){
      $m->flush();
            
      //ajout de l'autocomplession liée à session
      /*@var $session \Symfony\Component\HttpFoundation\Session\Session*/
      //$session = $this->get('session');
      //$session->getFlashBag()->add('success', 'Bravo, ton post ' . $req->get('title') . ' a été modifié avec succés!');
      
      $this->addFlash('success', 'Catégorie "' . $form['name']->getData() . '" modifiée avec succés!');
      
      return $this->redirect( $this->generateUrl('aston_back_category_list', []) );
    }
    
    return $this->render('AstonBackBundle:Category:form.html.twig', [
        'form' => $form->createView(),
    ]);
  }

  public function deleteAction(Request $req)
  {
    $m =$this->getDoctrine()->getManager();
    $repo = $m->getRepository('AstonBackBundle:Category');
    
    if(!($category = $repo->find($req->get('id')))){
      throw $this->createNotFoundException('Category not found');
    }
    
    $m->remove($category);
    $m->flush();
    
    return $this->redirect( $this->generateUrl('aston_back_category_list', []) );
  }
    
}
