<?php

namespace Aston\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

  public function indexAction()
  {
    $serviceHello = $this->get('aston_back.hello');

    \Symfony\Component\VarDumper\VarDumper::dump($serviceHello->sayHello());
    
    return $this->render('AstonBackBundle:Default:index.html.twig');
  }

}
