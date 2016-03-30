<?php

namespace Aston\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AstonBackBundle:Default:index.html.twig');
    }
}
