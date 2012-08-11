<?php

namespace Cookbook\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('CookbookSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
}
