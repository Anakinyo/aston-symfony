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
use Aston\BackBundle\Form\Type\PostType;

/**
 * Description of Post
 *
 * @author yoann
 */
class PostController extends Controller
{

  public function listAction()
  {
    return $this->render('AstonBackBundle:Post:list.html.twig', []);
  }

  public function addAction(Request $req)
  {
    $this->createForm('Aston\BackBundle\Form\Type\PostType');
    return $this->render('AstonBackBundle:Post:form.html.twig', []);
  }
  
  public function updateAction(Request $req)
  {
    return $this->render('AstonBackBundle:Post:form.html.twig', []);
  }

  public function deleteAction(Request $req)
  {
    return new Response();
  }
}
