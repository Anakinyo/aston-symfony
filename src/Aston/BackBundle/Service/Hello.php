<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Aston\BackBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of Hello
 *
 * @author dev
 */
class Hello
{
  private $name;
  private $session;

  public function __construct($name, $session)
  {
    $this->name = (string) $name;
    $this->session = $session;
  }

  public function sayHello()
  {
    $this->session->set('name', $this->name);
    return "Hello " . $this->name;
  }

}
