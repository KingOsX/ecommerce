<?php

namespace Vapamax\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VapamaxUserBundle:Default:index.html.twig');
    }
}
